<?php

namespace App\Services\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as MailException;

class MailService
{
    private function mailer(): PHPMailer
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = config('mail.mailers.smtp.host', 'smtp.gmail.com');
        $mail->SMTPAuth   = true;
        $mail->Username   = config('mail.mailers.smtp.username');
        $mail->Password   = config('mail.mailers.smtp.password');
        $mail->SMTPSecure = config('mail.mailers.smtp.encryption', 'ssl') === 'ssl'
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = (int) config('mail.mailers.smtp.port', 465);
        $mail->CharSet    = 'UTF-8';
        $mail->setFrom(
            config('mail.from.address', 'noreply@hmtif.ac.id'),
            config('mail.from.name',    'HMTIF UNPAS')
        );

        return $mail;
    }

    /**
     * Kirim notifikasi aspirasi masuk ke email admin.
     */
    public function sendAspirationNotification(array $aspiration): bool
    {
        $adminEmail = config('app.admin_email', config('mail.from.address'));

        try {
            $mail = $this->mailer();
            $mail->addAddress($adminEmail);
            $mail->Subject = '[Aspirasi Masuk] ' . $aspiration['subject'];
            $mail->isHTML(true);
            $mail->Body = $this->aspirationEmailBody($aspiration);
            $mail->AltBody = strip_tags($mail->Body);
            $mail->send();
            return true;
        } catch (MailException $e) {
            \Log::error('PHPMailer aspirasi error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim email reset password / welcome ke staff/user baru.
     */
    public function sendPasswordSetup(string $toEmail, string $toName, string $temporaryPassword): bool
    {
        try {
            $mail = $this->mailer();
            $mail->addAddress($toEmail, $toName);
            $mail->Subject = 'Akun HMTIF UNPAS — Set Password Anda';
            $mail->isHTML(true);
            $mail->Body    = $this->passwordSetupEmailBody($toName, $toEmail, $temporaryPassword);
            $mail->AltBody = strip_tags($mail->Body);
            $mail->send();
            return true;
        } catch (MailException $e) {
            \Log::error('PHPMailer setup-password error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim notifikasi update status aspirasi ke pelapor.
     */
    public function sendAspirationStatusUpdate(string $toEmail, string $subject, string $status, string $trackingCode): bool
    {
        try {
            $mail = $this->mailer();
            $mail->addAddress($toEmail);
            $mail->Subject = '[HMTIF] Update Aspirasi: ' . $subject;
            $mail->isHTML(true);
            $mail->Body    = $this->statusUpdateEmailBody($subject, $status, $trackingCode);
            $mail->AltBody = strip_tags($mail->Body);
            $mail->send();
            return true;
        } catch (MailException $e) {
            \Log::error('PHPMailer status-update error: ' . $e->getMessage());
            return false;
        }
    }

    // ─── Template Helpers ────────────────────────────────────────────────────

    private function baseTemplate(string $content): string
    {
        return <<<HTML
        <!DOCTYPE html>
        <html lang="id">
        <head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
          body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
          .wrapper { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
          .header  { background: #248232; color: #fff; padding: 28px 32px; }
          .header h1 { margin: 0; font-size: 22px; font-weight: 700; }
          .header p  { margin: 4px 0 0; font-size: 13px; opacity: .85; }
          .body    { padding: 28px 32px; color: #374151; line-height: 1.7; }
          .body h2 { color: #111827; font-size: 18px; margin-top: 0; }
          .info-box { background: #f9fafb; border-left: 4px solid #248232; border-radius: 6px; padding: 16px 20px; margin: 20px 0; }
          .info-box table { width: 100%; border-collapse: collapse; }
          .info-box td { padding: 4px 8px; font-size: 14px; vertical-align: top; }
          .info-box td:first-child { width: 160px; color: #6b7280; white-space: nowrap; }
          .footer { background: #f9fafb; padding: 16px 32px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
          .badge { display: inline-block; padding: 2px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }
          .badge-pending  { background: #fef9c3; color: #713f12; }
          .badge-reviewed { background: #dbeafe; color: #1e40af; }
          .badge-resolved { background: #dcfce7; color: #14532d; }
        </style></head>
        <body><div class="wrapper">
          <div class="header">
            <h1>HMTIF UNPAS</h1>
            <p>Himpunan Mahasiswa Teknik Informatika — Universitas Pasundan</p>
          </div>
          <div class="body">{$content}</div>
          <div class="footer">Email ini dikirim otomatis oleh sistem HMTIF UNPAS. Mohon jangan membalas email ini.</div>
        </div></body></html>
        HTML;
    }

    private function aspirationEmailBody(array $a): string
    {
        $name   = htmlspecialchars($a['name']    ?? 'Anonim');
        $nim    = htmlspecialchars($a['nim']     ?? '-');
        $email  = htmlspecialchars($a['email']   ?? '-');
        $subj   = htmlspecialchars($a['subject'] ?? '-');
        $msg    = nl2br(htmlspecialchars($a['message'] ?? ''));
        $code   = htmlspecialchars($a['tracking_code'] ?? '-');

        $content = <<<HTML
        <h2>Aspirasi Baru Masuk</h2>
        <p>Ada aspirasi baru yang masuk melalui website HMTIF UNPAS. Berikut detailnya:</p>
        <div class="info-box"><table>
          <tr><td>Tracking Code</td><td><strong>{$code}</strong></td></tr>
          <tr><td>Nama</td><td>{$name}</td></tr>
          <tr><td>NIM</td><td>{$nim}</td></tr>
          <tr><td>Email</td><td>{$email}</td></tr>
          <tr><td>Perihal</td><td>{$subj}</td></tr>
          <tr><td>Pesan</td><td>{$msg}</td></tr>
        </table></div>
        <p>Silakan login ke dashboard admin untuk menindaklanjuti aspirasi ini.</p>
        HTML;

        return $this->baseTemplate($content);
    }

    private function passwordSetupEmailBody(string $name, string $email, string $password): string
    {
        $name     = htmlspecialchars($name);
        $email    = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $adminUrl = url('/admin');

        $content = <<<HTML
        <h2>Selamat Datang, {$name}!</h2>
        <p>Akun Anda di sistem HMTIF UNPAS telah dibuat. Gunakan informasi berikut untuk login pertama kali:</p>
        <div class="info-box"><table>
          <tr><td>URL Admin</td><td><a href="{$adminUrl}">{$adminUrl}</a></td></tr>
          <tr><td>Email</td><td>{$email}</td></tr>
          <tr><td>Password Sementara</td><td><strong>{$password}</strong></td></tr>
        </table></div>
        <p><strong>Penting:</strong> Segera ubah password Anda setelah login pertama kali demi keamanan akun.</p>
        HTML;

        return $this->baseTemplate($content);
    }

    private function statusUpdateEmailBody(string $subject, string $status, string $trackingCode): string
    {
        $subject      = htmlspecialchars($subject);
        $trackingCode = htmlspecialchars($trackingCode);
        $statusLabel  = match ($status) {
            'reviewed' => 'Sedang Ditinjau',
            'resolved' => 'Selesai Ditangani',
            default    => 'Menunggu Tindak Lanjut',
        };
        $badgeClass = "badge-{$status}";

        $content = <<<HTML
        <h2>Update Status Aspirasi Anda</h2>
        <p>Status aspirasi yang Anda kirimkan telah diperbarui:</p>
        <div class="info-box"><table>
          <tr><td>Tracking Code</td><td><strong>{$trackingCode}</strong></td></tr>
          <tr><td>Perihal</td><td>{$subject}</td></tr>
          <tr><td>Status Baru</td><td><span class="badge {$badgeClass}">{$statusLabel}</span></td></tr>
        </table></div>
        <p>Anda dapat memantau status aspirasi Anda melalui fitur lacak aspirasi di website HMTIF UNPAS.</p>
        HTML;

        return $this->baseTemplate($content);
    }
}

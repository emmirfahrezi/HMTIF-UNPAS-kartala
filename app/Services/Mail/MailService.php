<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;
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
            config('mail.from.name', 'HMTIF UNPAS')
        );

        return $mail;
    }

    /**
     * Kirim email setup password ke pengurus/user baru (link token).
     */
    public function sendPasswordSetupLink(string $toEmail, string $setupUrl): bool
    {
        try {
            $mail = $this->mailer();
            $mail->addAddress($toEmail);
            $mail->Subject = 'Akun HMTIF UNPAS — Atur Password Anda';
            $mail->isHTML(true);
            $mail->Body    = view('mail.setup-password', [
                'email'    => $toEmail,
                'setupUrl' => $setupUrl,
            ])->render();
            $mail->AltBody = "Akun dashboard HMTIF-UNPAS telah dibuat untuk {$toEmail}. Kunjungi: {$setupUrl} untuk mengatur password Anda.";
            $mail->send();
            return true;
        } catch (MailException $e) {
            Log::error('PHPMailer setup-password-link error: ' . $e->getMessage());
            return false;
        }
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
            $mail->Subject = '[Aspirasi Masuk] ' . ($aspiration['subject'] ?? '-');
            $mail->isHTML(true);
            $mail->Body    = view('mail.aspiration-incoming', [
                'trackingCode' => $aspiration['tracking_code'] ?? '-',
                'name'         => $aspiration['name']          ?? '',
                'nim'          => $aspiration['nim']           ?? null,
                'email'        => $aspiration['email']         ?? null,
                'subject'      => $aspiration['subject']       ?? '-',
                'message'      => $aspiration['message']       ?? '',
            ])->render();
            $mail->AltBody = strip_tags($mail->Body);
            $mail->send();
            return true;
        } catch (MailException $e) {
            Log::error('PHPMailer aspirasi error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim notifikasi update status aspirasi ke pelapor.
     *
     * @param string $toEmail      Email pelapor
     * @param string $name         Nama pelapor
     * @param string $subject      Subjek aspirasi
     * @param string $status       pending|reviewed|resolved|rejected
     * @param string $trackingCode Kode tracking aspirasi
     * @param string $message      Pesan balasan admin (opsional)
     */
    public function sendAspirationStatusUpdate(
        string $toEmail,
        string $name,
        string $subject,
        string $status,
        string $trackingCode,
        string $message = ''
    ): bool {
        try {
            $mail = $this->mailer();
            $mail->addAddress($toEmail);
            $mail->Subject = '[HMTIF] Update Aspirasi: ' . $subject;
            $mail->isHTML(true);
            $mail->Body    = view('mail.aspiration-feedback', compact(
                'name', 'subject', 'status', 'trackingCode', 'message'
            ))->render();
            $mail->AltBody = strip_tags($mail->Body);
            $mail->send();
            return true;
        } catch (MailException $e) {
            Log::error('PHPMailer status-update error: ' . $e->getMessage());
            return false;
        }
    }
}

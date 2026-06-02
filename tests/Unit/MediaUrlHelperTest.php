<?php

uses(Tests\TestCase::class);

/*
|--------------------------------------------------------------------------
| Test: media_url() helper
|--------------------------------------------------------------------------
|
| Memverifikasi semua kasus path yang mungkin tersimpan di database
| dikembalikan sebagai URL yang benar oleh helper media_url().
|
*/

it('returns placeholder asset when path is null', function () {
    $result = media_url(null, 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('images/placeholders/activity.svg'));
});

it('returns placeholder asset when path is empty string', function () {
    $result = media_url('', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('images/placeholders/activity.svg'));
});

it('returns external https url as-is', function () {
    $url = 'https://example.com/photo.jpg';
    expect(media_url($url, 'images/placeholders/activity.svg'))->toBe($url);
});

it('returns external http url as-is', function () {
    $url = 'http://example.com/photo.jpg';
    expect(media_url($url, 'images/placeholders/activity.svg'))->toBe($url);
});

it('resolves upload relative path with storage prefix', function () {
    $result = media_url('activities/thumbnails/example.jpg', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('storage/activities/thumbnails/example.jpg'));
});

it('resolves staffs upload path with storage prefix', function () {
    $result = media_url('staffs/photos/example.jpg', 'images/placeholders/member.svg');
    expect($result)->toBe(asset('storage/staffs/photos/example.jpg'));
});

it('resolves path that already has storage/ prefix without doubling', function () {
    $result = media_url('storage/activities/thumbnails/example.jpg', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('storage/activities/thumbnails/example.jpg'));
    expect($result)->not->toContain('storage/storage/');
});

it('resolves path with leading /storage/ without doubling', function () {
    $result = media_url('/storage/activities/thumbnails/example.jpg', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('storage/activities/thumbnails/example.jpg'));
    expect($result)->not->toContain('storage/storage/');
});

it('resolves images/ path to asset without storage prefix', function () {
    $result = media_url('images/placeholders/activity.svg', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('images/placeholders/activity.svg'));
    expect($result)->not->toContain('storage/images/');
});

it('resolves path with leading /images/ without storage prefix', function () {
    $result = media_url('/images/custom/photo.svg', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('images/custom/photo.svg'));
    expect($result)->not->toContain('storage/images/');
});

it('resolves path with leading slash correctly', function () {
    $result = media_url('/some/path.jpg', 'images/placeholders/activity.svg');
    expect($result)->toBe(asset('some/path.jpg'));
});

it('uses correct placeholder per domain', function () {
    expect(media_url(null, 'images/placeholders/activity.svg'))
        ->toBe(asset('images/placeholders/activity.svg'));

    expect(media_url(null, 'images/placeholders/announcement.svg'))
        ->toBe(asset('images/placeholders/announcement.svg'));

    expect(media_url(null, 'images/placeholders/product.svg'))
        ->toBe(asset('images/placeholders/product.svg'));

    expect(media_url(null, 'images/placeholders/member.svg'))
        ->toBe(asset('images/placeholders/member.svg'));
});

# Laravel Medium Clone

A Medium-style blogging platform built with Laravel, following the [freeCodeCamp / The Codeholic tutorial](https://www.youtube.com/watch?v=MG1kt_wiIz0).

## Features

- User registration & login (Laravel Breeze)
- Email verification
- Create, edit, and delete posts with cover images (resized with Intervention Image)
- Markdown article content with plain-text excerpts on the feed
- Categories with slug-based filtering
- Like / unlike posts
- Follow / unfollow authors
- **For you** and **Following** feeds
- Comments on posts
- Public author profiles (`/@username`)
- Profile bio and avatar upload

## Requirements

- PHP 8.3+
- Composer
- Node.js & npm
- MySQL (or SQLite for local dev)
- GD extension (for image processing)

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medium_clone
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Visit `http://127.0.0.1:8000`.

### Default test user (after seeding)

- **Email:** test@example.com  
- **Password:** password  

(Register a new account if you prefer.)

## Project structure

| Area | Location |
|------|----------|
| Routes | `routes/web.php` |
| Post logic | `app/Http/Controllers/PostController.php` |
| Likes / follows / comments | `LikeController`, `FollowController`, `CommentController` |
| Feed UI | `resources/views/post/index.blade.php` |
| Post cards | `resources/views/components/post-item.blade.php` |

## Routes overview

| URL | Description |
|-----|-------------|
| `/` | Landing page (guests) |
| `/dashboard` | Article feed (auth) |
| `/post/create` | New article |
| `/post/{slug}` | Read article (public) |
| `/@{username}` | Author profile |

## Tutorial reference

- [YouTube course](https://www.youtube.com/watch?v=MG1kt_wiIz0)
- [freeCodeCamp article](https://www.freecodecamp.org/news/learn-laravel-by-building-a-medium-clone/)

## License

MIT

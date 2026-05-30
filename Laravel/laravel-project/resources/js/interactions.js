const csrfToken = () =>
    document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

const jsonHeaders = () => ({
    Accept: 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': csrfToken(),
});

const heartFilled = `
<svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
</svg>`;

const heartOutline = `
<svg class="w-5 h-5 fill-none stroke-current stroke-2 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
</svg>`;

function updateLikeButton(form, liked, likesCount) {
    const icon = form.querySelector('[data-like-icon]');
    const count = form.querySelector('[data-like-count]');

    if (icon) {
        icon.innerHTML = liked ? heartFilled : heartOutline;
    }

    if (count) {
        count.textContent = likesCount;
    }

    form.dataset.liked = liked ? 'true' : 'false';
}

async function handleLikeSubmit(event) {
    event.preventDefault();

    const form = event.currentTarget;
    const button = form.querySelector('button[type="submit"]');

    if (button?.disabled) {
        return;
    }

    if (button) {
        button.disabled = true;
    }

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: jsonHeaders(),
            body: new FormData(form),
        });

        if (response.status === 401) {
            window.location.href = '/login';
            return;
        }

        if (! response.ok) {
            throw new Error('Like request failed');
        }

        const data = await response.json();
        updateLikeButton(form, data.liked, data.likes_count);
    } catch (error) {
        console.error(error);
    } finally {
        if (button) {
            button.disabled = false;
        }
    }
}

function updateFollowButton(form, following, followersCount) {
    const button = form.querySelector('[data-follow-button]');
    const countEl = document.querySelector('[data-followers-count]');

    if (button) {
        button.textContent = following ? 'Unfollow' : 'Follow';
        button.classList.toggle('bg-gray-900', ! following);
        button.classList.toggle('hover:bg-gray-800', ! following);
        button.classList.toggle('text-white', ! following);
        button.classList.toggle('bg-gray-100', following);
        button.classList.toggle('border', following);
        button.classList.toggle('border-gray-200', following);
        button.classList.toggle('hover:bg-gray-200', following);
        button.classList.toggle('text-gray-700', following);
    }

    if (countEl) {
        countEl.textContent = followersCount;
    }

    form.dataset.following = following ? 'true' : 'false';
}

async function handleFollowSubmit(event) {
    event.preventDefault();

    const form = event.currentTarget;
    const button = form.querySelector('[data-follow-button]');

    if (button?.disabled) {
        return;
    }

    if (button) {
        button.disabled = true;
    }

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: jsonHeaders(),
            body: new FormData(form),
        });

        if (response.status === 401) {
            window.location.href = '/login';
            return;
        }

        if (! response.ok) {
            throw new Error('Follow request failed');
        }

        const data = await response.json();
        updateFollowButton(form, data.following, data.followers_count);
    } catch (error) {
        console.error(error);
    } finally {
        if (button) {
            button.disabled = false;
        }
    }
}

export function initInteractions() {
    document.querySelectorAll('[data-like-form]').forEach((form) => {
        form.addEventListener('submit', handleLikeSubmit);
    });

    document.querySelectorAll('[data-follow-form]').forEach((form) => {
        form.addEventListener('submit', handleFollowSubmit);
    });
}

document.addEventListener('DOMContentLoaded', initInteractions);

/**
 * Load-more подгрузка новостей.
 *
 * Кнопка имеет настоящий href на ?PAGEN_1=N+1 — без JS работает как обычная
 * пагинация. JS перехватывает клик, fetch'ит ту же страницу, парсит HTML,
 * апендит карточки в .news-list__grid. Это паттерн progressive enhancement:
 * базовая функциональность работает без JS, JS улучшает UX.
 */
(function () {
    'use strict';

    function findGrid() {
        return document.querySelector('.news-list__grid');
    }

    function findButton() {
        return document.querySelector('.load-more-btn');
    }

    async function handleClick(event) {
        const btn = event.currentTarget;
        const href = btn.getAttribute('href');
        if (!href) return;

        event.preventDefault();

        const grid = findGrid();
        if (!grid) return;

        const originalText = btn.textContent;
        btn.classList.add('is-loading');
        btn.textContent = 'Загрузка…';

        try {
            const response = await fetch(href, { credentials: 'same-origin' });
            if (!response.ok) throw new Error('HTTP ' + response.status);

            const html = await response.text();
            const doc  = new DOMParser().parseFromString(html, 'text/html');

            const newCards = doc.querySelectorAll('.news-list__grid > .news-card');
            newCards.forEach(card => grid.appendChild(card));

            const newBtn = doc.querySelector('.load-more-btn');
            if (newBtn) {
                btn.setAttribute('href', newBtn.getAttribute('href'));
                btn.classList.remove('is-loading');
                btn.textContent = originalText;
            } else {
                // Страниц больше нет — убираем кнопку.
                btn.remove();
            }
        } catch (err) {
            console.error('Не удалось подгрузить новости:', err);
            btn.classList.remove('is-loading');
            btn.textContent = originalText;
        }
    }

    function init() {
        const btn = findButton();
        if (btn) btn.addEventListener('click', handleClick);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();

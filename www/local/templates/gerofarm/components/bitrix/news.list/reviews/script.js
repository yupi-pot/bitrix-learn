// Скрипт загружен с атрибутом defer — DOM уже готов, DOMContentLoaded не нужен.
// Swiper CDN тоже defer и стоит раньше в DOM, поэтому Swiper уже доступен.

new Swiper('.reviews-swiper', {
    centeredSlides: true,
    slidesPerView: 'auto',

    // Все слайды одинаковой ширины 624px (см. style.css). Зазор между визуальными
    // карточками (≈8px как в Figma) уже заложен в эту ширину — внешний spaceBetween не нужен.
    spaceBetween: 0,

    // Стартуем со 2-го слайда — при centeredSlides он окажется по центру, и сразу
    // видны 3 карточки: 1-я слева, 2-я (активная и большая) центр, 3-я справа.
    initialSlide: 1,
    grabCursor: true,

    // loop отключён — при slidesPerView:'auto' + centeredSlides + малом числе слайдов
    // Swiper создаёт ассиметричное число клонов и листание ломается в одну сторону.
    // Без loop поведение предсказуемо: упёрлись в первый/последний.
    // autoplay тоже выключен — в макете не указан.

    pagination: {
        el: '.reviews-swiper__pagination',
        clickable: true,
    },
});

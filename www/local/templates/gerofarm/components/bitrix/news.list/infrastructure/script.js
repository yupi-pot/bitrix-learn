(function () {
    var DURATION = 5000;
    var CIRCUMFERENCE = 175.93;

    function InfraSlider(section) {
        this.section   = section;
        this.img       = section.querySelector('.home-infra__img');
        this.items     = Array.prototype.slice.call(section.querySelectorAll('.infra-item'));
        this.current   = 0;
        this.rafId     = null;
        this.startTime = null;

        console.log('[InfraSlider] init, items:', this.items.length, 'img:', this.img);

        var self = this;
        this.items.forEach(function (item, i) {
            item.addEventListener('click', function () {
                console.log('[InfraSlider] click item', i);
                self.goTo(i);
            });
        });

        this.goTo(0);
    }

    InfraSlider.prototype.goTo = function (index) {
        console.log('[InfraSlider] goTo', index);
        if (this.rafId) cancelAnimationFrame(this.rafId);

        this.items.forEach(function (item) {
            item.classList.remove('infra-item--active');
            var circle = item.querySelector('.infra-progress');
            if (circle) circle.style.strokeDashoffset = CIRCUMFERENCE;
        });

        this.items[index].classList.add('infra-item--active');
        this.current   = index;
        this.startTime = null;

        var newSrc = this.items[index].dataset.img;
        if (newSrc && this.img) {
            var img = this.img;
            img.style.opacity = '0';
            setTimeout(function () {
                img.src = newSrc;
                img.style.opacity = '1';
            }, 350);
        }

        var self = this;
        this.rafId = requestAnimationFrame(function (ts) { self.tick(ts); });
    };

    InfraSlider.prototype.tick = function (ts) {
        if (!this.startTime) this.startTime = ts;
        var elapsed  = ts - this.startTime;
        var progress = Math.min(elapsed / DURATION, 1);

        var circle = this.items[this.current].querySelector('.infra-progress');
        if (circle) {
            circle.style.strokeDashoffset = CIRCUMFERENCE * (1 - progress);
        }

        if (progress < 1) {
            var self = this;
            this.rafId = requestAnimationFrame(function (ts) { self.tick(ts); });
        } else {
            this.goTo((this.current + 1) % this.items.length);
        }
    };

    function init() {
        console.log('[InfraSlider] init called, readyState:', document.readyState);
        var section = document.querySelector('.home-infra__body');
        console.log('[InfraSlider] section found:', !!section);
        if (section) new InfraSlider(section);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();

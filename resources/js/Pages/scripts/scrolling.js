export const scroll_JS = {
    scrollCheck: function (sections) {
        var scroll_data = {
            'html_height': document.body.scrollHeight,
            'screen_height': window.innerHeight,
            'Ytop_value': window.pageYOffset,
            'Ybottom_value': window.pageYOffset + window.innerHeight,
        };
        sections.forEach((sec) => {
            if (
                sec.offsetTop <
                3 * (scroll_data.screen_height / 4) +
                scroll_data.Ytop_value
            ) {
                sec.classList.add("anim_it");
            }
        });
    }
}
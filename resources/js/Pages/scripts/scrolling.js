export const scrollF = {
    scroll_JS: function () {
            var scroll_data = {
                'html_height':    document.body.scrollHeight,
                'screen_height':  window.innerHeight,
                'Ytop_value':     window.pageYOffset,
                'Ybottom_value':  window.pageYOffset + window.innerHeight,
            };
            return scroll_data;
            // var height = {'body_sh': body.scrollHeight, 
            //             'body_oh': body.offsetHeight, 
            //             'html_ch':html.clientHeight,    
            //             'html_sh':html.scrollHeight,    
            //             'html_oh':html.offsetHeight};
    }
}
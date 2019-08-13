/*jslint maxparams: 4, maxdepth: 4, maxstatements: 20, maxcomplexity: 8 */
(function(window) {
    'use strict'; //Force strict mode

    const
        document = window.document,

        load = () => {
            document
                .querySelectorAll('[data-role~="show-hide-toggle"]')
                .forEach(
                    (button) => {
                        button
                            .addEventListener(
                                'click',
                                () => {

                                    const
                                        selectors = (button.getAttribute('data-show-hide-selectors') || '').split(',')
                                    ;

                                    if(selectors.length && !selectors[0]){
                                        throw 'You must set the data-show-hide-selectors attribute on the filter button';
                                    }

                                    selectors
                                        .forEach(
                                            (sel) => {

                                                const
                                                    elems = document.querySelectorAll(sel)
                                                ;

                                                if(!elems.length){
                                                    console.warn('Could not find element with selector: ' + sel);
                                                    return;
                                                }

                                                elems
                                                    .forEach(
                                                        (elem) => {
                                                            const
                                                                is_now_visible = elem.classList.toggle('visible'),
                                                                template_text = button.getAttribute('data-show-hide-template-text')
                                                            ;

                                                            if(!template_text){
                                                                console.warn('Show/hide template text supported but not used on current element');
                                                                return;
                                                            }

                                                            const
                                                                new_text = template_text.replace('%s', is_now_visible ? 'Hide' : 'Show')
                                                            ;

                                                            button.innerText = new_text;


                                                        }
                                                    )
                                                ;

                                            }
                                        )
                                    ;

                                }
                            )
                        ;
                    }
                )
            ;
        },

        init = () => {
            if (['complete', 'loaded', 'interactive'].includes(document.readyState)) {
                //If the DOM is already set, then just load
                load();
            } else {
                //Otherwise, wait for the readevent
                document.addEventListener('DOMContentLoaded', load);
            }
        }

    ;

    //Kick everything off
    init();
}
(window)
);
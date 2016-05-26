$(function() {

    /**
     * Parralax scrolling and litebox
     * (desktops only, buggy on mobile)
     */
    if ((IS_MOBILE || IS_TABLET) == false) {

        /**
         * Parallax scrolling initialisation
         */
        $.stellar();
    }

});
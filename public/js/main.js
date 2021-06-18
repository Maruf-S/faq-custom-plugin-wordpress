(function($){

    var isLoading = false;
    var selectedCategory = '-1';

    $(function () {

        var $ItemsContainer = $('#faq-items-container');

        $('#faq-categories-menu').on('click', 'a', function(ev) {
            ev.preventDefault();

            $this = $(this);

            selectedCategory = $this.data('category');

            if( isLoading || isLoading === $(this).data('category')) return false;

            isLoading = true;

            $ItemsContainer.empty().addClass('loading');
            $('#faq-categories-menu a').removeClass('active');
            $this.addClass('active');

            $.post(ajax_url, {
                action: 'faq_category_posts',
                category: selectedCategory,
                description: $this.data('description')
            }, function(response) {
                $ItemsContainer.removeClass('loading').html(response);
                isLoading = false;
            });



            return false;
        });

    });

})(jQuery);
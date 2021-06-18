<?php get_header(); ?>

<?php
$queried_item = get_queried_object();
?>

<div id="primary" class="content-area">
    <div class="content-container site-container">

        <main id="main" class="site-main" role="main">

            <header class="entry-header faqs-archive-title ">
                <?php do_action('faq_archive_before_entry_header'); ?>

<!--                <h1 class="page-title archive-title">--><?php //echo __('Frequently Asked Questions'); ?><!--</h1>-->

                <?php do_action('faq_archive_after_entry_header'); ?>
            </header>

            <div id="faq-categories" class="content-wrap">
                <?php
                $faq_categories = get_terms(array(
                    'taxonomy' => 'faq_category',
                    'hide_empty' => false,
                ));
                ?>
                <?php if (!empty($faq_categories)): ?>
                    <div id="faq-categories-menu">
                        <ul>
                            <?php foreach ($faq_categories as $faq_category): ?>
                                <li>
                                    <a data-description="<?php echo empty($faq_category->description) ? $faq_category->name : $faq_category->description; ?>"
                                       data-category="<?php echo $faq_category->term_id; ?>"
                                       href="<?php echo get_term_link($faq_category->term_id); ?>"<?php if($queried_item->term_id == $faq_category->term_id):?> class="active"<?php endif; ?>>
                                        <span><?php echo $faq_category->name; ?></span>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.964 7.60619L4.92031 2.10463C4.90191 2.09014 4.87979 2.08113 4.8565 2.07865C4.8332 2.07616 4.80968 2.08029 4.78863 2.09057C4.76758 2.10085 4.74986 2.11686 4.7375 2.13676C4.72514 2.15666 4.71864 2.17964 4.71875 2.20306V3.41088C4.71875 3.48744 4.75469 3.56088 4.81406 3.60775L10.439 7.99994L4.81406 12.3921C4.75313 12.439 4.71875 12.5124 4.71875 12.589V13.7968C4.71875 13.9015 4.83906 13.9593 4.92031 13.8953L11.964 8.39369C12.0239 8.34699 12.0723 8.28725 12.1057 8.21902C12.139 8.15079 12.1563 8.07587 12.1563 7.99994C12.1563 7.92401 12.139 7.84908 12.1057 7.78085C12.0723 7.71262 12.0239 7.65289 11.964 7.60619Z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div id="faq-items-container">

                        <?php if( !is_post_type_archive('faq') && $queried_item): ?>

                            <?php
                            $category_faqs_query = new WP_Query(array(
                                'post_type' => 'faq',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'faq_category',
                                        'field' => 'term_id',
                                        'terms' => $queried_item->term_id,
                                    ),
                                )
                            ));

                            $current_title = empty($faq_category->description) ? $faq_category->name : $faq_category->description;
                            echo '<div class="">';

                            echo '<h2>Browse: ' . $current_title . '</h2>';

                            while($category_faqs_query->have_posts()) {
                                $category_faqs_query->the_post();
                                include FAQS_PATH . 'templates/faq-loop.php';
                            }

                            echo '</div>';
                            ?>

                        <?php endif; ?>

                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>
</div>

<?php get_footer(); ?>

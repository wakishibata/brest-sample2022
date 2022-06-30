<?php
get_header(); ?>


   <section class="l-innerwrap l-innerwrap--wide p-block--higher">

        <?php if(is_front_page() || is_home() || is_page_template('front-page.php')) : ?>
            <div class="c-heading__pagettl-en">
              <h1 class="c-heading__pagettl-en__body"><?php bloginfo('name'); ?></h1>
            </div>
        <?php elseif(is_archive() || is_tax() || is_category()) : ?>
            <div class="c-heading__pagettl-en">
              <h1 class="c-heading__pagettl-en__body"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
            </div>
        <?php elseif(is_single()) : ?>
            <div class="c-heading__pagettl-en">
              <p class="c-heading__pagettl-en__body"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></p>
            </div>
        <?php endif; ?>

        <div class="p-page__single c-column clearfix">
            <?php if ( is_archive() ) : ?>
                <?php if ( is_day() ) : ?>
                <h2 class="p-page__archive__heading p-block--lower"><?php printf(__('DAILY ARCHIVE: <span>%s</span>', 'sandbox'), get_the_time(get_option('date_format'))) ?></h2>
                <?php elseif ( is_month() ) : ?>
                <h2 class="p-page__archive__heading p-block--lower"><?php printf(__('MONTHLY ARCHIVE: <span>%s</span>', 'sandbox'), get_the_time('Y.m')) ?></h2>
                <?php elseif ( is_year() ) : ?>
                <h2 class="p-page__archive__heading p-block--lower"><?php printf(__('YEARLY ARCHIVE: <span>%s</span>', 'sandbox'), get_the_time('Y.')) ?></h2>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ( is_tax() || is_category() ) : ?>
                <h2 class="p-page__archive__heading p-block--lower">CATEGORY: <?php single_term_title() ?></h2>
            <?php endif; ?>
            <section class="p-page__single__right c-column--right p-block--higher">
                <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" class="p-page__single__body p-block--lower">
                    <?php if(is_front_page() || is_home() || is_page_template('front-page.php')) : ?>
                        <h2 class="p-page__single__body__ttl"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>の記事へ"><?php the_title(); ?></a></h2>
                    <?php elseif(is_archive() || is_tax() || is_category()) : ?>
                        <h2 class="p-page__single__body__ttl"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>の記事へ"><?php the_title(); ?></a></h2>
                    <?php elseif(is_single()) : ?>
                        <h1 class="p-page__single__body__ttl"><?php the_title(); ?></h1>
                    <?php endif; ?>
                    <div class="p-page__single__body__meta">
                        <p class="p-page__single__body__meta__date"><?php the_time('Y.m.d'); ?></p>
                        <?php
                        $news_terms = wp_get_object_terms( $post->ID,  'news_cat' );
                          if ( ! empty( $news_terms ) ) {
                              if ( ! is_wp_error( $news_terms ) ) {
                                  echo '<ul class="p-page__single__body__meta__category">';
                                      foreach( $news_terms as $term ) {
                                          echo '<li class="p-page__single__body__meta__category__item">' . esc_html( $term->name ) . '</li>';
                                      }
                                  echo '</ul>';
                              }
                          }
                        ?>
                    </div>
                    <div class="editor-styles-wrapper">
                        <?php if(is_single()) : ?>
                            <?php the_content();
                            wp_link_pages(
                                array(
                                    'before'           => '<nav class="post-nav-links"><span class="post-nav-ttl">' . __( 'Pages:' ) . '</span>',
                                    'after'            => '</nav>',
                                    'link_before'      => '',
                                    'link_after'       => '',
                                    'next_or_number'   => 'number',
                                    'separator'        => ' ',
                                    'pagelink'         => '%',
                                    'echo'             => 1
                                )
                            );?>
                        <?php else: ?>
                            <?php the_content('Read on...');?>
                        <?php endif; ?>
                        <p style="text-align:right;"><?php edit_post_link(__('<i class="fas fa-pencil-alt"></i>この記事を編集する', 'kubrick'), '', ''); ?></p>
                    </div>
                </article>
                <?php endwhile; ?>
                <?php if(is_single()) : ?>
                    <nav  class="p-page__single__pagenation p-block--lower">
                    <div class="p-page__single__pagenation__item u-align--right"><span class="c-btn-underline-from-center"><?php previous_post_link('%link', '<i class="fas fa-long-arrow-alt-left fa-fw"></i> %title'); ?></span></div>
                    <div class="p-page__single__pagenation__item u-align--left"><span class="c-btn-underline-from-center"><?php next_post_link('%link', '%title <i class="fas fa-long-arrow-alt-right fa-fw"></i></i>'); ?></span></div>
                </nav>
                <?php endif; ?>
                <div class="u-align--center">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-btn-inline-bkline u-f12"><i class="fas fa-th fa-fw"></i>Back to top page</a>
                </div>
            </section>
            <div class="p-page__single__left c-column--left p-block--higher">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
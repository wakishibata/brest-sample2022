                <section class="p-page__sidebar p-block--lower">
                    <h2 class="p-page__sidebar__ttl">CATEGORY</h2>
                    <?php // get_terms を使ったターム一覧の表示
                      $taxonomy_terms = get_terms('category'); // タクソノミースラッグを指定
                      if(!empty($taxonomy_terms)&&!is_wp_error($taxonomy_terms)){
                        echo '<ul class="p-page__sidebar__item">';
                        foreach($taxonomy_terms as $taxonomy_term): // foreach ループの開始
                    ?>
                    <li><a href="<?php echo get_term_link($taxonomy_term); ?>" class="<?php if($taxonomy_term->slug === $term){ echo 'current'; } ?>"><?php echo $taxonomy_term->name; ?></a></li>
                    <?php
                        endforeach; // foreach ループの終了
                        echo '</ul>';
                      }
                    ?>
                </section>
                <section class="p-page__sidebar p-block--lower">
                    <h2 class="p-page__sidebar__ttl">ARCHIVE</h2>
                    <select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;' class=" c-form__select">
                      <option value=""><?php echo attribute_escape(__('月を選択')); ?></option>
                      <?php wp_get_archives (array(
                        'post_type' => 'post',
                        'type' => 'monthly',
                        'format' => 'option',
                        'show_post_count' => '1',
                        'limit' => '12'
                        ));
                      ?>
                    </select>
                </section>
                <?php if(is_front_page() || is_home() || is_page_template('front-page.php')) : ?>
                <section class="p-page__sidebar p-block--lower">
                    <h2 class="p-page__sidebar__ttl">TAG LIST</h2>
                    <ul class="p-page__sidebar__item">
                    <li><?php wp_tag_cloud('smallest=7&largest=11'); ?></li>
                    </ul>
                </section>
                <section class="p-page__sidebar p-block--lower">
                    <h2 class="p-page__sidebar__ttl">ADMINISTRATOR</h2>
                    <ul class="p-page__sidebar__item">
                    <li><?php wp_register(); ?></li>
                    <li><?php wp_loginout(); ?></li>
                    </ul>
                </section>
			 <section class="p-page__sidebar  p-block--lower">
				 <p>Git連携テスト用の記入です、表示されていたらok<br>shiba</p>
			 </section>
                <?php endif; ?>
<!-- これはサブループでいいんだな… -->
<!-- サブループをベースにしているので、中級者の方はこちらの方がカスタマイズしやすいと思います。 -->
<?php get_header(); ?>

<div class="blog">

    <ul class="blog-list">

        <?php
            $args = [
                'tax_query' => array(
                    array(
                      'taxonomy' => 'blog_cat',
                      //タクソノミーを指定
                      'field' => 'slug',
                      //ターム名をスラッグで指定する
                      'terms' => 'trip',
                      // なにこれ（セルフ）
                    ),
                  ),
                  'post_type' => 'blog',
                  // 投稿タイプのスラッグを指定
                  'post_status' => 'publish',
                  // 公開済の投稿を指定
                  'posts_per_page' => -1,
                  // すべての投稿
            ];
            // https://hirashimatakumi.com/blog/5409.html
            // ありがとうな…😭
            $blog_posts = new WP_Query( $args );
            // WP_Queryバージョン
            // https://zenn.dev/ohno/articles/33fab94b9b9228
            $terms = get_terms('blog_cat');
            // 条件を指定してタクソノミー情報を検索し、マッチしたすべてのデータを取得する。
        ?>

        <?php
            if ( $blog_posts -> have_posts() ) :
                while ( $blog_posts -> have_posts() ) :
                //  while文は、式の値がtrueである間、 入れ子の文を繰り返し実行することをPHPに指示します。
                // have_posts
                // この関数は現在の WordPress クエリにループできる結果があるかどうかをチェックします。ブール型関数で、TRUE または FALSE を返します。
                    $blog_posts -> the_post();
                    // ループを次の投稿へ進めます。 次の投稿を取得して、それを「現在の投稿」としてセットアップし、ループの 'in the loop' プロパティを true にします。
                    // 「現在の投稿」はループの中で the_title() や the_content() 等が対象とする投稿です。
                    // 'in the loop' プロパティはループの中であるかどうかを示します。これは in_the_loop() 条件分岐タグを使って確かめることができます。
        ?>

            <li class="blog-item">
                <a href="<?php the_permalink(); ?>">
                    <figure>
                        <?php
                            if ( has_post_thumbnail() ):
                                the_post_thumbnail();
                            endif;
                        ?>
                    </figure>
                    <p>
                        <?php
                            $term = get_the_terms( 0, 'blog_cat' );
                            // var_dump($term);
                            // array(1)ってなってるけど？？？？？
                            // 投稿に属するタームを単体で取得
                            // タームを単体で取得する関数は「get_the_terms」を使用します。
                            // 投稿に属するタームを取得するので、主に投稿一覧ページ、投稿詳細ページで使用します。
                            // 「タクソノミースラッグ」と記載されている箇所には、登録したカスタムタクソノミーのスラッグを入れてください。
                            echo esc_html( $term[0] -> name );
                            // これ$term[0]なしじゃいけなかったけど配列の中に配列みたいな感じだったん？？？？？？？
                        ?>
                        <!-- get_the_terms - 投稿記事のタクソノミー情報を取得する -->
                        <!-- 投稿ID（数値）または投稿情報（オブジェクト）を指定（省略時は0）。 -->
                        <!-- マッチしたすべてのタクソノミー情報が格納された配列を返す。パラメータ$taxonomyで指定された名前が無効な場合はfalseを返す。タクソノミー情報のプロパティは次の通り。 -->
                    </p>
                    <p>
                        <?php the_time('Y年 n月'); ?>
                    </p>
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                    <?php the_content(); ?>
                </a>
            </li>

        <?php endwhile; ?>

        <?php else : // 記事がない場合 ?>

            <li>まだ投稿がありません。</li>

        <?php endif;
            wp_reset_postdata();
        ?>

    </ul>
    <!-- /ブログ３件出力 -->

    <ul>
        <?php
            foreach ( $terms as $term ) :
                // echo '<li><a href="'.get_term_link($term).'">'.$term->name.'</a></li>';
        ?>

                <li>
                    <a href="<?php echo esc_url( get_term_link($term) ); ?>">
                    <!-- /get_term_link()は、指定したタクソノミーのURLアドレスを取得する関数です。 -->
                        <?php echo esc_html($term -> name); ?>
                        <!-- これget的なことになるんだ -->
                        <!-- esc_html一旦使おう… -->
                    </a>
                </li>

            <?php endforeach; ?>


    </ul>
    <!-- /カスタム投稿「ブログ」のブログカテゴリ一覧出力 -->

</div>
<!-- /ブログ（WP_Query） -->

<?php get_footer();

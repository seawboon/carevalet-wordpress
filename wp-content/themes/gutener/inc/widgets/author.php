<?php
/**
* Gutener Author Widget
*
* @since Gutener 1.0.0
*/
if( ! class_exists( 'Gutener_Author_Widget' ) ) :
    
    class Gutener_Author_Widget extends Gutener_Base_Widget {

        var $image_field = 'image';  // the image field ID

        public function __construct() {

            $widget_ops = array(
                'description' => esc_html__( 'Widget for your profile.', 'gutener' ), 
                'customize_selective_refresh' => true
            );
            
            parent::__construct(
                'gutener_author_widget', 
                esc_html__( 'Gutener Author', 'gutener' ),
                $widget_ops
            );

            $this->fields = array(
                'title' => array(
                    'label'   => esc_html__( 'Widget Title', 'gutener' ),
                    'type'    => 'text',
                    'default' => esc_html__( 'About the Author', 'gutener' )
                ),
                'page_id' => array(
                    'label' => esc_html__( 'Select Page', 'gutener' ),
                    'type'  => 'dropdown-pages',
                ),
                'full-square-thumb' => array(
                    'label'   => esc_html__( 'Enable Full Square thumbnail', 'gutener' ),
                    'type'    => 'checkbox',
                    'default' => false,
                ),
                'page_title' => array(
                    'label'   => esc_html__( 'Enable Page Title', 'gutener' ),
                    'type'    => 'checkbox',
                    'default' => true,
                ),
                'excerpt_count' => array(
                    'label'   => esc_html__( 'Excerpt Words count to show.', 'gutener' ),
                    'type'    => 'number',
                    'default' => 20,
                ),
                'sub_title' => array(
                    'label'   => esc_html__( 'Sub Title', 'gutener' ),
                    'type'    => 'text',
                    'default' => esc_html__( 'Lifestyle Blogger','gutener' )
                ),
                'social_title' => array(
                    'label'   => esc_html__( 'Social Icons', 'gutener' ),
                    'type'    => 'description',
                ),
                 'social_desc' => array(
                    'label'   => esc_html__( 'Input Icon name. For Example:- fab fa-facebook. For more icons https://fontawesome.com/icons?d=gallery&m=free', 'gutener' ),
                    'type'    => 'description',
                ),
                'social_menu_icon_1' => array(
                    'label' => esc_html__( 'Social Menu Icon One', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_1' => array(
                    'label' => esc_html__( 'Social Menu Link One', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_2' => array(
                    'label' => esc_html__( 'Social Menu Icon Two', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_2' => array(
                    'label' => esc_html__( 'Social Menu Link Two', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_3' => array(
                    'label' => esc_html__( 'Social Menu Icon Three', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_3' => array(
                    'label' => esc_html__( 'Social Menu Link Three', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_4' => array(
                    'label' => esc_html__( 'Social Menu Icon Four', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_4' => array(
                    'label' => esc_html__( 'Social Menu Link Four', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_5' => array(
                    'label' => esc_html__( 'Social Menu Icon Five', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_5' => array(
                    'label' => esc_html__( 'Social Menu Link Five', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_6' => array(
                    'label' => esc_html__( 'Social Menu Icon Six', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_6' => array(
                    'label' => esc_html__( 'Social Menu Link Six', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_7' => array(
                    'label' => esc_html__( 'Social Menu Icon Seven', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_7' => array(
                    'label' => esc_html__( 'Social Menu Link Seven', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_8' => array(
                    'label' => esc_html__( 'Social Menu Icon Eight', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_8' => array(
                    'label' => esc_html__( 'Social Menu Link Eight', 'gutener' ),
                    'type'  => 'text',
                ),
                'social_menu_icon_9' => array(
                    'label' => esc_html__( 'Social Menu Icon Nine', 'gutener' ),
                    'type'  => 'text',
                ), 
                'social_menu_link_9' => array(
                    'label' => esc_html__( 'Social Menu Link Nine', 'gutener' ),
                    'type'  => 'text',
                ),
            );
        }

        public function widget( $args, $instance ) {
            
            echo $args[ 'before_widget' ];

            $instance = $this->init_defaults( $instance );
            $unique_id = uniqid();
            ?>
            <?php if( $instance[ 'page_id' ] ):
                $author_thumbnail_class = '';
                if( !$instance[ 'full-square-thumb' ] ){
                    $author_thumbnail_class = 'author-thumbnail';
                }
            ?>

            <section class="author-widget class-<?php echo esc_attr( $unique_id ); ?> <?php echo esc_attr( $author_thumbnail_class ); ?>">
                <?php
                if( !isset( $instance[ 'title' ] ) || empty( $instance[ 'title' ] ) ){
                    $instance[ 'title' ] = esc_html__( 'About Author', 'gutener' );
                }
                echo '<div class="widget-title-wrap">' . $args[ 'before_title'] . esc_html( $instance[ 'title' ] ) . $args[ 'after_title' ] . '</div>';

                $query = new WP_Query( array(
                    'p'         => $instance[ 'page_id' ],
                    'post_type' => 'page'
                ) );

                while( $query->have_posts() ){
                    $query->the_post();
                    if( $instance[ 'full-square-thumb' ] ){
                        $src = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                    }else {
                        $src = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
                    }
                    $image_id = get_post_thumbnail_id();
                    $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
                ?>
                <div class="widget-content">
                    <div class="profile">
                        <?php if( has_post_thumbnail() ){ ?>
                            <figure class="avatar">
                                 <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo $alt; ?>">
                                 </a>
                            </figure>
                        <?php } ?>
                        <div class="text-content">
                            <div class="name-title">
                                <?php if( $instance[ 'page_title' ] == true ){ ?>
                                    <h3>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                <?php } ?>
                                <span><?php echo esc_html( $instance[ 'sub_title' ] ); ?></span>
                            </div>
                            <?php
                                $excerpt_count = $instance[ 'excerpt_count' ];
                                $excerpt_length = get_theme_mod( 'post_excerpt_length', $excerpt_count );
                                gutener_excerpt( $excerpt_length , true );
                            ?>
                        </div>
                        <?php if( $instance[ 'social_menu_icon_1' ] || $instance[ 'social_menu_icon_2' ] || $instance[ 'social_menu_icon_3' ] || $instance[ 'social_menu_icon_4' ] || $instance[ 'social_menu_icon_5' ] || $instance[ 'social_menu_icon_6' ] || $instance[ 'social_menu_icon_7' ] || $instance[ 'social_menu_icon_8' ] || $instance[ 'social_menu_icon_9' ] ){ ?>
                            <div class="socialgroup">
                                <ul>
                                    <?php
                                    if( $instance[ 'social_menu_icon_1' ] ){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_1' ] ); ?>">
                                                <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_1' ] ); ?>"></i>
                                            </a>
                                        </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_2' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_2' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_2' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_3' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_3' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_3' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_4' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_4' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_4' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_5' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_5' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_5' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_6' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_6' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_6' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_7' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_7' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_7' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_8' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_8' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_8' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    if( $instance[ 'social_menu_icon_9' ] ){
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_url( $instance[ 'social_menu_link_9' ] ); ?>">
                                            <i class="<?php echo esc_attr( $instance[ 'social_menu_icon_9' ] ); ?>"></i>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    }
                ?>
            </section>
            <?php endif; ?>
            <?php
            
            wp_reset_postdata();
            echo $args[ 'after_widget' ];
        }
    }

endif;
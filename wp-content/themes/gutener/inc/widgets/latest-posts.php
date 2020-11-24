<?php
/**
* Gutener Recent/Popular Post Widget
* 
* @since Gutener 1.0.0
*/
if ( ! class_exists( 'Gutener_Latest_Posts_Widget' ) ) :

class Gutener_Latest_Posts_Widget extends Gutener_Base_Widget{

	public $defaults = array();

	public function __construct(){

		parent::__construct(
			'gutener_latest_post',
			esc_html__( 'Gutener Latest Posts', 'gutener' ),
			array(
				'description' => esc_html__( 'Widget for Latest posts', 'gutener' )
			)
		);

		$defaults = array(
			'per_page' => 5,
			'show_date_comment' => true,
			'layout' => 'left'
		);

		$this->defaults = apply_filters( 'gutener_rcs_widget_default', $defaults );

		$this->fields = array(
			'title' => array(
				'label' => esc_html__( 'Title', 'gutener' ),
				'type' => 'text'
			),
			'per_page' => array(
				'label'   => esc_html__( 'Number of Posts', 'gutener' ),
				'type'    => 'number',
				'min'     => 1,
				'max'     => $this->defaults[ 'per_page' ],
				'default' => $this->defaults[ 'per_page' ],
			),
			'show_date_comment' => array(
				'label' => esc_html__( 'Show Date & Comments', 'gutener' ),
				'type' => 'checkbox',
				'default' => $this->defaults[ 'show_date_comment' ]
			),
			'layout' => array(
				'label' => esc_html__( 'Layout', 'gutener' ),
				'type' => 'radio',
				'choices' => array(
					'left' => esc_html__( 'Left Thumbnail', 'gutener' ),
					'full' => esc_html__( 'Full Thumbnail', 'gutener' )
				),
				'default' => $this->defaults[ 'layout' ]
			)
		);
	}

	public function widget( $args, $instance ){

		echo $args[ 'before_widget' ];
		
		$instance = $this->init_defaults( $instance );
		$query_args = apply_filters( 'gutener_post_widget_query_args', array(
			'posts_per_page'      => $instance[ 'per_page' ],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1
		), $instance );

		$class = ( 'left' == $instance[ 'layout' ] ) ?  'left-thumb-widget' : 'full-thumb-widget';
		?>
		<!-- sidebar category slide widget -->
		<section class="wrapper sidebar-item latest-posts-widget <?php echo esc_attr( $class ); ?>">
			<?php 
			if( !isset( $instance[ 'title' ] ) || empty( $instance[ 'title' ] ) ){
				$instance[ 'title' ] = esc_html__( 'Latest Posts', 'gutener' );
			}

			echo $args[ 'before_title' ] . esc_html( $instance[ 'title' ] )   . $args[ 'after_title' ]; 
			?>

			<div class="widget-content">
			<?php
				$this->query_it( $query_args, $instance ); 
			?>
			</div>
		</section>
		<?php
		
		echo $args[ 'after_widget' ];
	}

	public function query_it( $query_args, $instance ){

		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ){
			
			while ( $query->have_posts() ){ 
				$query->the_post();
				$this->item( $instance );
			}
			
		}else{
			?>
			<p class="text-center">
				<?php esc_html_e( 'No Posts Found.', 'gutener' ); ?>
			</p>
			<?php
		} 
		wp_reset_postdata();
	}
	
	public function item( $instance ){
		?>
		<article class="post">
		    <?php
		   
		   		if( has_post_thumbnail() ){
		   			if ( $instance[ 'layout' ] == 'full' ){
		   				$src = get_the_post_thumbnail_url( get_the_ID(), 'gutener-290-150' );
		   			}else {
		   				$src = get_the_post_thumbnail_url( get_the_ID(), 'gutener-80-60' );
		   			}

			   		$image_id = get_post_thumbnail_id();
			   		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
		   		?>
	   		    <figure class="featured-image">
	   		        <a href="<?php the_permalink(); ?>">
	   		          	<img src="<?php echo esc_url( $src ); ?>" alt="<?php echo $alt; ?>"/>
	   		        </a>
	   		    </figure>
		   		<?php } ?>

		   
			<div class="post-content">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title();  ?>
					</a>
				</h3>
				<div class="entry-meta">
					<?php if( $instance[ 'show_date_comment' ] ): ?>
						  <span class="posted-on">
						       <a href="<?php echo esc_url( gutener_get_day_link() ); ?>" >
						            <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
						            	<?php echo esc_html( get_the_date('M m, Y') ); ?>
						            </time>
						       </a>
						  </span>
						  <span class="comments-link">
						   <a href="<?php comments_link(); ?>">
							   	<?php echo esc_html( wp_count_comments( get_the_ID() )->approved ); ?>
						   </a>
						</span>
				 	<?php endif; ?>
				</div>
			</div>
		</article>
		<?php
	}
}

endif;
<?php
/**
 * Range Slider Customizer Control - O2 Customizer Library
 *
 * This control adds range slider to the Customizer which allows
 * you to choose number from a range slider.
 *
 * Range Slider is a part of O2 library, which is a
 * free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this library. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package O2 Customizer Library
 * @subpackage Range Slider
 * @since 0.1
 */
	class MediHealth_Customizer_Range_Slider_Control extends WP_Customize_Control {

		public $type = 'medihealth-range-slider';

		public function to_json() {
			if ( ! empty( $this->setting->default ) ) {
				$this->json['default'] = $this->setting->default;
			} else {
				$this->json['default'] = false;
			}
			parent::to_json();
		}

		public function enqueue() {
			wp_enqueue_script( 'medihealth-range-slider', trailingslashit( get_template_directory_uri() ) . '/include/customizer/controls/range-slider/assets/js/range-slider-control.js', array( 'jquery' ), '', true );
			wp_enqueue_style( 'medihealth-range-slider', trailingslashit( get_template_directory_uri() ) . '/include/customizer/controls/range-slider/assets/css/range-slider-control.css' );
		}

		public function render_content() {
		?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<div id="<?php echo esc_attr( $this->id ); ?>">
					<div class="medihealth-range-slider">
						<input class="medihealth-range-slider-range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?> />
						<input class="medihealth-range-slider-value" type="number" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?> />
					</div>
				</div>
			</label>
		<?php }

	}

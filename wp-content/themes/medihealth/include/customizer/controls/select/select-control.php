<?php
/**
 * Select Customizer Control - O2 Customizer Library
 *
 * This control adds a select list to the Customizer which allows
 * you to pick an option from a drop down list.
 *
 * Select is a part of O2 library, which is a
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
 * @subpackage Select
 * @since 0.1
 */
	class MediHealth_Customizer_Select_Control extends WP_Customize_Control {

		public $type = 'medihealth-select';

		public function enqueue() {
			wp_enqueue_style( 'medihealth-selectize-css', trailingslashit( get_template_directory_uri() ) . '/include/customizer/assets/selectize/css/selectize.default.css' );
			wp_enqueue_script( 'medihealth-select-control', trailingslashit( get_template_directory_uri() ) . '/include/customizer/controls/select/assets/js/select-control.js', array( 'jquery', 'selectize-js' ), '', true );
			wp_enqueue_script( 'medihealth-selectize-js', trailingslashit( get_template_directory_uri() ) . '/include/customizer/assets/selectize/js/standalone/selectize.min.js', array( 'jquery' ) );

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
				<select <?php $this->link(); ?> class="medihealth-select-control">
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php echo selected( $this->value(), $value, false ); ?> ><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		<?php }
	}

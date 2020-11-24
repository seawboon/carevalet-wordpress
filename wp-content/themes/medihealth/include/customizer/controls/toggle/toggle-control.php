<?php
/**
 * Toggle Customizer Control - O2 Customizer Library
 *
 * This control adds a toggle box to the Customizer which allows
 * you to have a checkbox field with toggle control.
 *
 * Toggle is a part of O2 library, which is a
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
 * @subpackage Toggle
 * @since 0.1
 */
	class MediHealth_Customizer_Toggle_Control extends WP_Customize_Control {

		public $type = 'medihealth-toggle';

		public function enqueue() {
			wp_enqueue_script( 'medihealth-toggle', trailingslashit( get_template_directory_uri() ) . '/include/customizer/controls/toggle/assets/js/toggle-control.js', '', '', true );
			wp_enqueue_style( 'medihealth-toggle', trailingslashit( get_template_directory_uri() ) . '/include/customizer/controls/toggle/assets/css/toggle-control.css' );
		}

		public function render_content() {
		?>
			
				<div id="<?php echo esc_attr( $this->id ); ?>" class="medihealth-toggle">
					<?php if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php endif; ?>
					
					<label class="switch">
						<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> >
						<div class="slider round"></div>
					</label>
					
					<?php if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>
				</div>
			
		<?php }

	}

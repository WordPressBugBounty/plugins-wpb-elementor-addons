<?php
/**
 * @author  WpBean
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;

class WPB_EA_Videos_Grid extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-ea-videos-grid';
	}

	public function get_title() {
		return esc_html__( 'WPB Videos Grid', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

	public function get_categories() {
		return array( 'wpb_ea_widgets' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'wpb_ea_videos_grid',
			array(
				'label' => esc_html__( 'Vides Grid', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'column',
			array(
				'label'   => esc_html__( 'Number of Columns', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 4,
				'options' => array(
					6 => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
					4 => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
					3 => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
					2 => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
					1 => esc_html__( '1 Columns', 'wpb-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'details_text',
			array(
				'label'       => esc_html__( 'Details Text', 'wpb-elementor-addons' ),
				'description' => esc_html__( 'Details link text.', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Details', 'wpb-elementor-addons' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'video_type',
			array(
				'label'       => esc_html__( 'Video Type', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => true,
				'default'     => 'youtube',
				'options'     => array(
					'youtube'     => array(
						'title' => esc_html__( 'YouTube', 'wpb-elementor-addons' ),
						'icon'  => 'fa fa-youtube',
					),
					'self_hosted' => array(
						'title' => esc_html__( 'Self Hosted', 'wpb-elementor-addons' ),
						'icon'  => 'fa fa-upload',
					),
				),
			)
		);

		$repeater->add_control(
			'youtube_url',
			array(
				'label'     => esc_html__( 'YouTube Video Link', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::URL,
				'condition' => array(
					'video_type' => 'youtube',
				),
			)
		);

		$repeater->add_control(
			'self_hosted',
			array(
				'label'      => esc_html__( 'Upload Your Video', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::MEDIA,
				'media_type' => 'video',
				'condition'  => array(
					'video_type' => 'self_hosted',
				),
			)
		);

		$repeater->add_control(
			'video_thumbnail',
			array(
				'label' => esc_html__( 'Video Poster', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'video_title',
			array(
				'label'       => esc_html__( 'Video Title', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Video Title', 'wpb-elementor-addons' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'video_content',
			array(
				'label' => esc_html__( 'Video Content', 'wpb-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$repeater->add_control(
			'details_link',
			array(
				'label' => esc_html__( 'Video Details Link', 'wpb-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::URL,
			)
		);

		$this->add_control(
			'video_items',
			array(
				'label'       => esc_html__( 'Video Items', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'video_type'    => 'youtube',
						'youtube_url'   => array( 'url' => 'https://www.youtube.com/watch?v=wtOuQx8Ko7U' ),
						'video_title'   => esc_html__( 'Elementor Post Grid', 'wpb-elementor-addons' ),
						'video_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'wpb-elementor-addons' ),
					),
					array(
						'video_type'    => 'youtube',
						'youtube_url'   => array( 'url' => 'https://www.youtube.com/watch?v=_qK1ovtRGbw' ),
						'video_title'   => esc_html__( 'Elementor News Ticker', 'wpb-elementor-addons' ),
						'video_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'wpb-elementor-addons' ),
					),
					array(
						'video_type'    => 'youtube',
						'youtube_url'   => array( 'url' => 'https://www.youtube.com/watch?v=hKOY6iikbMk' ),
						'video_title'   => esc_html__( 'Elementor TimeLine', 'wpb-elementor-addons' ),
						'video_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'wpb-elementor-addons' ),
					),
				),
				'title_field' => '{{{ video_title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_video_grid_style_section',
			array(
				'label' => esc_html__( 'Style Settings', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wpb_ea_video_grid_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-videos-grid-item-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_grid_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => 20,
					'right'  => 20,
					'bottom' => 20,
					'left'   => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-video-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_grid_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 30,
					'left'   => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-videos-grid-item-column' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_grid_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#292929',
				'selectors' => array(
					'{{WRAPPER}} .wpb-video-content h3' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_grid_content_color',
			array(
				'label'     => esc_html__( 'Content Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => array(
					'{{WRAPPER}} .wpb-video-content p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_grid_link_color',
			array(
				'label'     => esc_html__( 'Details Link Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#2d2d2d',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-vg-details-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$column       = 12 / $settings['column'];
		$column_class = apply_filters( 'wpb_ea_videos_grid_column_class', 'col-lg-' . esc_attr( $column ) . ' col-md-6' );

		$video_items = $settings['video_items'];
		$yt_args     = array(
			'height' => 146,
			'width'  => 260,
		);

		$hosted_args['controlsList'] = 'nodownload';
		// $hosted_args['muted'] = 'muted';
		$hosted_args['controls'] = '';

		if ( isset( $video_items ) && ! empty( $video_items ) ) {
			?>
			<div class="wpb-ea-videos-grid">
				<div class="ea-row">
					<?php foreach ( $video_items as $video_item ) : ?>

						<?php
						$video_type = $video_item['video_type'];

						if ( ! empty( $video_item['details_link']['url'] ) ) {
							$this->add_link_attributes( 'details_link', $video_item['details_link'] );
						}

						if ( $video_type == 'self_hosted' ) {

							if ( $video_item['video_thumbnail']['url'] ) {
								$hosted_args['poster'] = $video_item['video_thumbnail']['url'];
							} else {
								$hosted_args['poster'] = '';
							}
						}
						?>

						<div class="wpb-ea-videos-grid-item-column <?php echo esc_attr( $column_class ); ?>">
							<div class="wpb-ea-videos-grid-item">
								<div class="wpb-ea-videos-grid-item-inner">
									<?php
									if ( $video_type == 'youtube' ) {
										echo ( $video_item['youtube_url']['url'] ? wp_oembed_get( $video_item['youtube_url']['url'], $yt_args ) : '' ); // WPCS: XSS OK.
									} elseif ( $video_type == 'self_hosted' ) {
										if ( $video_item['self_hosted']['url'] ) {
											echo '<video class="elementor-video" src="' . esc_url( $video_item['self_hosted']['url'] ) . '" ' . wp_kses_data( Utils::render_html_attributes( $hosted_args ) ) . '></video>';
										}
									}
									?>
									<div class="wpb-video-content">
										<?php echo ( $video_item['video_title'] ? sprintf( '<h3>%s</h3>', esc_html( $video_item['video_title'] ) ) : '' ); ?>
										<?php echo ( $video_item['video_content'] ? wp_kses_post( wpautop( $video_item['video_content'] ) ) : '' ); ?>
										<?php
										if ( $video_item['details_link']['url'] ) {
											echo '<a class="wpb-ea-vg-details-link" ' . wp_kses_data( $this->get_render_attribute_string( 'details_link' ) ) . '>' . esc_html( apply_filters( 'wpb_ea_videos_grid_details_text', $settings['details_text'] ) ) . '</a>';
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
	}
}
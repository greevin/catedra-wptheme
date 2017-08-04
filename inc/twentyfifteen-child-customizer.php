<?php

class Twenty_Fifteen_Child_Customizer {
	
	public function __construct() {
		
		add_action( 'customize_register', array( $this, 'register_customize_sections' ) );
		
	}
	
	public function register_customize_sections( $wp_customize ) {
		
		$this->colours_section( $wp_customize );
		
	}
	
	private function colours_section( $wp_customize ) {
		
        // Cor de fundo do rodapé
		$wp_customize->add_setting( 'footer-background', array(
					'default'           => '#123652',
					'sanitize_callback' => 'sanitize_hex_color'
				) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer-background', array(
					'label'    => esc_html__( 'Cor do rodapé', 'twentyfifteen-child' ),
					'section'  => 'colors',
					'settings' => 'footer-background',
					'priority' => 10
				) ) );
		
        // Cor do texto do rodapé
		$wp_customize->add_setting( 'footer-text-color', array(
					'default'           => '#d8d8d8',
					'sanitize_callback' => 'sanitize_hex_color'
				) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer-text-color', array(
					'label'    => esc_html__( 'Cor do texto do rodapé', 'twentyfifteen-child' ),
					'section'  => 'colors',
					'settings' => 'footer-text-color',
					'priority' => 10
				) ) );
        
        // Cor de fundo do post.
        $wp_customize->add_setting( 'post-background-color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post-background-color', array(
            'label'       => __( 'Cor de fundo do post', 'twentyfifteen-child' ),
            'section'     => 'colors',
            'settings' => 'post-background-color',
        ) ) );

        // Cor de fundo do post.
        $wp_customize->add_setting( 'post-text-color', array(
            'default'           => '#7b7b7b',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post-text-color', array(
            'label'       => __( 'Cor do texto do post', 'twentyfifteen-child' ),
            'section'     => 'colors',
            'settings' => 'post-text-color',
        ) ) );

        // Cor de fundo do Mais Informações.
        $wp_customize->add_setting( 'more-info-background-color', array(
            'default'           => '#123652',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'more-info-background-color', array(
            'label'       => __( 'Cor de fundo do Mais Informações', 'twentyfifteen-child' ),
            'section'     => 'colors',
            'settings' => 'more-info-background-color',
        ) ) );

        // Cor de fundo do Mais Informações.
        $wp_customize->add_setting( 'more-info-text-color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'more-info-text-color', array(
            'label'       => __( 'Cor do texto do Mais Informações', 'twentyfifteen-child' ),
            'section'     => 'colors',
            'settings' => 'more-info-text-color',
        ) ) );

        // Cor do fundo do cabeçalho das páginas internas.
        $wp_customize->add_setting( 'inside-page-color', array(
            'default'           => '#123652',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inside-page-color', array(
            'label'       => __( 'Cor do fundo do cabeçalho das páginas internas', 'twentyfifteen-child' ),
            'section'     => 'colors',
            'settings' => 'inside-page-color',
        ) ) );

        // Cor do fundo do cabeçalho das páginas internas.
        $wp_customize->add_setting( 'inside-page-text-color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inside-page-text-color', array(
            'label'       => __( 'Cor do texto do cabeçalho das páginas internas', 'twentyfifteen-child' ),
            'section'     => 'colors',
            'settings' => 'inside-page-text-color',
        ) ) );
		
	}
	
}

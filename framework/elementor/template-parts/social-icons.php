<?php

$class_animation = '';

if ( ! empty( $boutique_social['hover_animation'] ) ) {
  $class_animation = ' elementor-animation-' . $boutique_social['hover_animation'];
}

?>

<div class="footer-social-media">
    <div class="container-fluid acurate">
        <ul>
          <?php
          foreach ( $boutique_social['social_icon_list'] as $index => $item ) {
            $social = str_replace( 'fa fa-', '', $item['social'] );

            $link_key = 'link_' . $index;

            $this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

            if ( $item['link']['is_external'] ) {
              $this->add_render_attribute( $link_key, 'target', '_blank' );
            }

            if ( $item['link']['nofollow'] ) {
              $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
            }
          ?>
            <li><a class="elementor-icon elementor-social-icon elementor-social-icon-<?php echo $social . $class_animation; ?>" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
              <span class="elementor-screen-only"><?php echo ucwords( $social ); ?></span>
              <i class="<?php echo $item['social']; ?>"></i>
            </a></li>
          <?php } ?>
        </ul>
    </div>
</div>

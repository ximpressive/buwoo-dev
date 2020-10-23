<?php 

  global $boutique;
  $editorjs_ft            =   $boutique['editor-footer-js'];

  boutique_theme_footer();
  
?>
    </div><!--/.bwo-pcnt-->
  </div><!--/.pc-c-->
</div><!--/.wrapper-->

        <div id="popup-search-box-area" >
          <a href="#" class="close-button btn-search-form-toggle">
              <span class="fa fa-times" aria-hidden="true"></span>
          </a>
          <div class="container-fluid home-v3-pd">
              <form id="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <div class="form-group">
                      <input type="search" class="form-control search-box" placeholder="<?php echo esc_attr_x( 'Search Your Keyword Here&hellip;', 'placeholder', 'boutique' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
                  </div>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
              </form>
          </div>
        </div>
        
        <!-- footer end here -->

      
    <?php if($editorjs_ft){?>    
      <script type="text/javascript">
        <?php echo $editorjs_ft; ?>
      </script>
    <?php } ?>


    <?php wp_footer(); ?>
    </body>
</html>
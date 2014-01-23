<?php
  // fcd1, 8/27/13: foolowing file is based on plugins/ExhibitBuilder/views/public/exhibits/item.php
  // with customization to match behavior of cul-teneral's item.php from OMeka 1.5.3
?>

<?php
  echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),
		  'bodyclass' => 'exhibits exhibit-item-show'));
?>

<div id="item-page-content">
  <div id="primary" class="show">
    <h3 class="exhibit-title-link">Exhibit: 
    <?php echo exhibit_builder_link_to_exhibit(null,null,array('class' => 'link-to-exhibit')); ?>
    </h3>
    <table>
      <tr>
        <td>
          <?php
            if (array_key_exists('HTTP_REFERER',$_SERVER)) {
              $http_previous = $_SERVER['HTTP_REFERER'];
              echo '<a href="'.$http_previous.'">Return to exhibit page</a>';
            }
          ?>
          <h1 class="item-title">Item Information</h1>
            <div id="itemfiles">
              <?php 
                // fcd1, 01/16/14:
                // change imageSize from thumbnail (as set in original code)
                // to fullsize
                echo files_for_item(array('imageSize' => 'fullsize',
					  'linkAttributes' => array('onclick' => 'return hs.expand(this)',
								    'class' => 'highslide')
					  )
				    );
              ?>
            </div>

          <?php echo all_element_texts('item'); ?>

          <?php if (metadata('item', 'has tags')): ?>
            <div class="tags">
              <h3><?php echo __('Tags'); ?></h3>
              <?php echo tag_string('item'); ?>
            </div>
          <?php endif;?>

          <div id="citation" class="field">
            <h3><?php echo __('Citation'); ?></h3>
            <p id="citation-value" class="field-value"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></p>
          </div>
          <?php cul_display_links_to_exhibit_pages_containing_item(); ?>
        </td>
      </tr>
    </table>
  </div><!--end id="primary"-->
</div><!--end id="item-page-content"-->

<?php echo foot(); ?>

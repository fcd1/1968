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
    <table>
      <tr>
        <td>
          <h1 class="item-title">Item Information</h1>
            <div id="itemfiles">
              <?php 
                echo files_for_item(array('imageSize' => 'thumbnail',
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
        </td>
      </tr>
    </table>
  </div><!--end id="primary"-->
</div><!--end id="item-page-content"-->

<?php echo foot(); ?>

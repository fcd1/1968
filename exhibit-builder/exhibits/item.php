<?php
  echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),
		  'bodyclass' => 'exhibits exhibit-item-show'));
?>

<div id="item-page-content">
  <div id="primary" class="show">
    <h3 class="exhibit-title-link">Exhibition: 
    <?php echo exhibit_builder_link_to_exhibit(null,null,array('class' => 'link-to-exhibit')); ?>
    </h3>
    <table>
      <tr>
        <td>
          <?php
            // fcd1, 01/31/14:
            // Retrieve, in an array, the list of exhibit pages containing the current item.
            $exhibit_pages = CulCustomizePlugin::return_exhibit_pages_containing_current_item();

            // fcd1, 01/30/14
            // Print out a link back to the exhibit page we came from.
            // The second parameter is set to TRUE to indicate this is a legacy exhibition
            $exhibit_page_containing_item = 
              CulCustomizePlugin::return_exhibit_page_to_link_back_to($exhibit_pages, TRUE);
            if ($exhibit_page_containing_item) {
	      $link_title = $exhibit->title.': ';
	      $parent_page = $exhibit_page_containing_item->getParent();
	      $link_title .= ( $parent_page ? $parent_page->title . ': ' : '');
              $link_title .= $exhibit_page_containing_item->title.'</a></p>';
              echo '<h3>View item in context</h3>';
              echo '<p><a href="'.
                html_escape(exhibit_builder_exhibit_uri($exhibit, $exhibit_page_containing_item)).
                '">'.$link_title.'</a></p>';
            }

            // fcd1, 01/30/14:
            // Print out a list of other exhibit pages containing the item
            // CulCustomizePlugin::display_links_to_exhibit_pages_containing_item takes
            // care of filtering out $exhibit_page_containing_item, since we already
            // displayed a link to that page
            if(!empty($exhibit_pages)) {
	      CulCustomizePlugin::display_links_to_exhibit_pages_containing_item(
										 $exhibit_pages,
										 $exhibit_page_containing_item);
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
        </td>
      </tr>
    </table>
  </div><!--end id="primary"-->
</div><!--end id="item-page-content"-->

<?php echo foot(); ?>

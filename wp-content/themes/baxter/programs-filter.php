<?php
  $programs_filter = array("Program Aperture Baxter", "Program Conversations", "Program Call for Curators", "Program Coffee Talks", "Program DEI Task Force", "Program Call for Mid-Career", "Program Photo Book Share", "Program Zine and Photo Book Fair", "Program Past Lectures",  "Program Critique Groups");
  $all_categories = get_categories();
  $excluded_category_ids = array();
  foreach ($all_categories as $category) {
      if (in_array($category->name, $programs_filter)) {
          $excluded_category_ids[] = $category->term_id;
      }
  }
?>

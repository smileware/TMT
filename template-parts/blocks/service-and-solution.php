<?php 
    $title = get_field("service_&_solution_section_title");
    $ss_items = get_field("service_&_solution_item");
?>

<div class="ss-section s-grid -d2">
    <div class="ss-left">
        <h3 class="ss-section-title"><?php echo $title; ?></h3>

        <?php 
            $check = 1; 
            foreach ($ss_items as $item){
                $name = $item['ss_name'];
                $url = $item['ss_link'];
                $img = $item['ss_image'];
                $is_selected = $item['ss_is_default_selected'];

                if($is_selected && $check == 1) { 
                    $class_name = 'active';
                    $check = 0; 
                }else { 
                    $class_name = '';
                }
                echo '<a href="'. $url .'" class="ss-item '. $class_name .'" data-ss-image="'. $img .'" >';
                echo $name;
                echo '</a>';
            }
        ?>
    </div>
    <div class="ss-right">
        <?php 
            $check = 1; 
            foreach ($ss_items as $item){
                $img = $item['ss_image'];
                $name = $item['ss_name'];
                $is_selected = $item['ss_is_default_selected'];

                if($is_selected && $check == 1) { 
                    $class_name = 'active';
                    $check = 0; 
                }else { 
                    $class_name = '';
                }
                echo '<img src="'. $img .'" alt="Image of '. $name .'" class="'. $class_name.'" />';
            }
        ?>
    </div>
</div>

<script>
  const ss_items = document.querySelectorAll('.ss-left .ss-item');
    const images = document.querySelectorAll('.ss-right img');
    let activeIndex = -1; // Tracks the index of the currently active item

    ss_items.forEach((item, index) => {
        item.addEventListener('mouseenter', function() {
            ss_items.forEach(it => it.classList.remove('active'));
            images.forEach(img => img.classList.remove('active'));

            item.classList.add('active');
            if(images[index]) {
                images[index].classList.add('active');
            }
            activeIndex = index;
        });
    });
</script>
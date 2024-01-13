<?php 
    $boards = get_field("board_of_directors");
?>

<div class="board-directors">
    <?php 
        $idx = 1;
        foreach ($boards as $board) {
            $name = $board['name']; 
            $position = $board['position']; 
            $background = $board['background']; 
            $headshot = $board['headshot'];
            if($idx % 2 == 0) { 
                echo '<div class="s-grid -d2 -odd">';
                echo '<div class="info">';
                echo '<h3>'. $name .'</h3>';
                echo '<div class="position">'. $position .'</div>';
                echo '</div>';
                echo '<div  class="site-board s-modal-trigger" onclick="return false;"  data-popup-trigger="site-board" data-name="'. $name .'" data-position="'. htmlspecialchars($position, ENT_QUOTES, 'UTF-8') .'" data-background="'. htmlspecialchars($background, ENT_QUOTES, 'UTF-8') .'" data-img="'. htmlspecialchars($headshot, ENT_QUOTES, 'UTF-8') .'">';
                echo '<img src="'. $headshot .'"  alt="Headshor of '. $name .'"/>';
                echo '</div>';
                echo '</div>';
            }else { 
                echo '<div class="s-grid -d2 -even">';
                echo '<div  class="site-board s-modal-trigger" onclick="return false;"  data-popup-trigger="site-board" data-name="'. $name .'" data-position="'. htmlspecialchars($position, ENT_QUOTES, 'UTF-8') .'" data-background="'. htmlspecialchars($background, ENT_QUOTES, 'UTF-8') .'" data-img="'. htmlspecialchars($headshot, ENT_QUOTES, 'UTF-8') .'">';
                echo '<img src="'. $headshot .'"  alt="Headshor of '. $name .'"/>';
                echo '</div>';
                echo '<div class="info">';
                echo '<h3>'. $name .'</h3>';
                echo '<div class="position">'. $position .'</div>';
                echo '</div>';
                echo '</div>';
            }
            
            $idx += 1;
        }
    ?>
</div>
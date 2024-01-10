<?php 
    $groups = get_field("securities_analysts");
?>
<?php if($groups): ?>
    <div class="s-grid -d3 -m1 securities-analysts">
        <?php
            foreach($groups as $person) { 
                $company = $person['company_name'];
                $people = $person['securities_analyst'];

                echo '<div class="card-analyst">';
                echo '<div class="entry-title">';
                echo '<h3 class="company-name">'. $company .'</h3>';
                echo '<div class="divider"></div>';
                if(count($people) > 2) {
                    $grid = 2; 
                }else { 
                    $grid = count($people);
                }
                echo '</div>';
                echo '<div class="grid-person s-grid -d'. $grid .' -m1">';
                foreach($people as $individual) {
                    $name = $individual['name']; 
                    $email = $individual['email']; 
                    echo '<div class="person">';
                    echo '<div class="info">';
                    echo '<h4>'. $name . '</h4>';
                    echo seed_icon('mail') . '<span>'. $email . '</span>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }    
        ?>
    </div>
<?php endif; ?>
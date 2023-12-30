<div class="alignfull banner-bg">
    <?php 
        $bg = get_the_post_thumbnail_url( get_the_ID() , 'full');
    ?>
    <div class="overlay"></div>
    <div class="bg-image" style="background-image: url('<?php echo $bg; ?>');"></div>
</div>
<div class="meta-info">
    <div class="info-title">
        <div class="info-icon">
            <?php 
                $terms = get_the_terms(get_the_ID(), "job-type");
                foreach($terms as $term) { 
                    $icon = get_field("svg_icon", $term);
                    break;
                }
            ?>
            <?php echo $icon; ?>
        </div>
        <div class="info-text">
            <h2><?php echo the_title(); ?></h2>
            <div class="entry-info s-grid -d2 -m2">
                <?php 
                    $experince = get_field("job_experience", get_the_ID());
                    $location = get_field("job_location", get_the_ID());
                ?>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M16.6667 5.83203H3.33341C2.41294 5.83203 1.66675 6.57822 1.66675 7.4987V15.832C1.66675 16.7525 2.41294 17.4987 3.33341 17.4987H16.6667C17.5872 17.4987 18.3334 16.7525 18.3334 15.832V7.4987C18.3334 6.57822 17.5872 5.83203 16.6667 5.83203Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M13 6V3.33333C13 3.24493 12.842 3.16014 12.5607 3.09763C12.2794 3.03512 11.8978 3 11.5 3H8.5C8.10218 3 7.72064 3.03512 7.43934 3.09763C7.15804 3.16014 7 3.24493 7 3.33333V6"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <?php echo $experince; ?>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M17.5 8.33203C17.5 14.1654 10 19.1654 10 19.1654C10 19.1654 2.5 14.1654 2.5 8.33203C2.5 6.34291 3.29018 4.43525 4.6967 3.02873C6.10322 1.62221 8.01088 0.832031 10 0.832031C11.9891 0.832031 13.8968 1.62221 15.3033 3.02873C16.7098 4.43525 17.5 6.34291 17.5 8.33203Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M10 10.832C11.3807 10.832 12.5 9.71274 12.5 8.33203C12.5 6.95132 11.3807 5.83203 10 5.83203C8.61929 5.83203 7.5 6.95132 7.5 8.33203C7.5 9.71274 8.61929 10.832 10 10.832Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <?php echo $location; ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $cta = get_field("job_application_link", get_the_ID());
        if($cta) { 
            $link_url = $cta['url'];
            $link_title = $cta['title'];
            $link_target = $cta['target'] ? $cta['target'] : '_self';
    ?>
    <a class="entry-cta" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
        <?php _e("สมัครงาน", "wpml_theme"); ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
            <path
                d="M17.593 6.24928L17.5931 6.249C17.6959 6.0022 17.6403 5.71997 17.4511 5.53072L13.107 1.18666C12.8498 0.929446 12.4322 0.929446 12.175 1.18666C11.9177 1.44388 11.9177 1.86149 12.175 2.1187L15.3936 5.33737H1.01406C0.649916 5.33737 0.355566 5.63172 0.355566 5.99587C0.355566 6.36002 0.649916 6.65437 1.01406 6.65437H16.9842C17.2497 6.65437 17.4902 6.49395 17.593 6.24928Z"
                fill="white" stroke="white" stroke-width="0.2" />
            <path
                d="M12.1693 10.8115C12.2974 10.9415 12.4666 11.0051 12.6347 11.0051C12.8032 11.0051 12.9721 10.9413 13.1016 10.8117L17.4509 6.46246C17.7081 6.20524 17.7081 5.78763 17.4509 5.53041C17.1937 5.2732 16.7761 5.2732 16.5189 5.53041L12.1696 9.87971C11.9125 10.1368 11.9124 10.5542 12.1693 10.8115Z"
                fill="white" stroke="white" stroke-width="0.2" />
        </svg>
    </a>
    <?php
        }
    ?>
</div>


<div class="entry-content">
    <div class="left">
        <?php echo the_content(); ?>
    </div>
    <div class="right">
        <div class="benefit-container">
            <h3>
                <?php _e("BENEFIT", "wpml_theme"); ?>
            </h3>
            <div class="benefits">
                <?php 
                    $benefits = get_field("job_benefits", get_the_ID());
                    foreach( $benefits  as $benefit) {
                        $icon = $benefit['benefit_icon_svg'];
                        $title = $benefit['benefit_title'];
                        $description = $benefit['benefit_description'];
                        echo '<div class="benefit">';
                        echo '<div class="icon">'. $icon .'</div>';
                        echo '<div class="info">';
                        echo '<h4>'. $title .'</h4>';
                        if($description)  {
                            echo '<span>' . $description . '</span>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
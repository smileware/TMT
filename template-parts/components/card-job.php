<?php
/**
 * Loop Name: Content Card
 */
?>
<a href="<?php echo get_permalink(); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class('content-item -job'); ?>>
        <div class="info">
            <header class="entry-header">
                <h2 class="entry-title">
                    <?php the_title(); ?>
                </h2>
            </header>

            <div class="entry-info s-grid -d2 -m2">
                <?php 
                    $experince = get_field("job_experience", get_the_ID());
                    $location = get_field("job_location", get_the_ID());
                ?>
                <div>   
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M16.6667 5.83203H3.33341C2.41294 5.83203 1.66675 6.57822 1.66675 7.4987V15.832C1.66675 16.7525 2.41294 17.4987 3.33341 17.4987H16.6667C17.5872 17.4987 18.3334 16.7525 18.3334 15.832V7.4987C18.3334 6.57822 17.5872 5.83203 16.6667 5.83203Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13 6V3.33333C13 3.24493 12.842 3.16014 12.5607 3.09763C12.2794 3.03512 11.8978 3 11.5 3H8.5C8.10218 3 7.72064 3.03512 7.43934 3.09763C7.15804 3.16014 7 3.24493 7 3.33333V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo $experince; ?>
                </div>
                <div>   
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M17.5 8.33203C17.5 14.1654 10 19.1654 10 19.1654C10 19.1654 2.5 14.1654 2.5 8.33203C2.5 6.34291 3.29018 4.43525 4.6967 3.02873C6.10322 1.62221 8.01088 0.832031 10 0.832031C11.9891 0.832031 13.8968 1.62221 15.3033 3.02873C16.7098 4.43525 17.5 6.34291 17.5 8.33203Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 10.832C11.3807 10.832 12.5 9.71274 12.5 8.33203C12.5 6.95132 11.3807 5.83203 10 5.83203C8.61929 5.83203 7.5 6.95132 7.5 8.33203C7.5 9.71274 8.61929 10.832 10 10.832Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo $location; ?>
                </div>
            </div>
        </div>
    </article>
</a>
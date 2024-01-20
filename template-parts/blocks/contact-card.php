<?php 
    $place = get_field("contact_place");
    $address = get_field("contact_address");
    $phone = get_field("contact_phone");
    $fax = get_field("contact_fax");
    $email = get_field("contact_email");
    $link = get_field("contact_link");
    $is_large = get_field("contact_islarge");
    $map = get_field("contact_map");
?>

<?php if($is_large): ?>
    <a class="contact-card -large" href="<?php echo $link; ?>" target="_blank">
        <div class="info">
            <h3><?php echo $place; ?></h3>
            <div class="divider"></div>
            <div class="address"><?php echo $address; ?></div>
            <div class="icon-list">
                <?php if($phone): ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                        <path d="M13.75 11.0751V12.9501C13.7507 13.1241 13.7151 13.2964 13.6453 13.4559C13.5756 13.6154 13.4733 13.7586 13.3451 13.8762C13.2168 13.9939 13.0654 14.0835 12.9005 14.1393C12.7356 14.195 12.5609 14.2157 12.3875 14.2001C10.4643 13.9911 8.61689 13.3339 6.99377 12.2813C5.48366 11.3217 4.20335 10.0414 3.24377 8.53131C2.18751 6.90081 1.53017 5.04443 1.32502 3.11256C1.3094 2.93973 1.32994 2.76554 1.38533 2.60108C1.44072 2.43662 1.52975 2.28549 1.64675 2.15732C1.76374 2.02916 1.90615 1.92675 2.06489 1.85664C2.22363 1.78652 2.39523 1.75022 2.56877 1.75006H4.44377C4.74709 1.74708 5.04114 1.85448 5.27112 2.05227C5.5011 2.25005 5.65132 2.52471 5.69377 2.82506C5.77291 3.4251 5.91968 4.01426 6.13127 4.58131C6.21536 4.80501 6.23356 5.04813 6.18371 5.28186C6.13386 5.51559 6.01806 5.73013 5.85002 5.90006L5.05627 6.69381C5.94599 8.25853 7.24155 9.55409 8.80627 10.4438L9.60002 9.65006C9.76995 9.48202 9.98449 9.36622 10.2182 9.31637C10.4519 9.26652 10.6951 9.28472 10.9188 9.36881C11.4858 9.5804 12.075 9.72717 12.675 9.80631C12.9786 9.84914 13.2559 10.0021 13.4541 10.236C13.6523 10.4699 13.7576 10.7685 13.75 11.0751Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $phone; ?></span>
                    </div>
                <?php endif; ?>
                <?php if($fax): ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path d="M3.75 6.125V1.75H11.25V6.125" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.75 11.75H2.5C2.16848 11.75 1.85054 11.6183 1.61612 11.3839C1.3817 11.1495 1.25 10.8315 1.25 10.5V7.375C1.25 7.04348 1.3817 6.72554 1.61612 6.49112C1.85054 6.2567 2.16848 6.125 2.5 6.125H12.5C12.8315 6.125 13.1495 6.2567 13.3839 6.49112C13.6183 6.72554 13.75 7.04348 13.75 7.375V10.5C13.75 10.8315 13.6183 11.1495 13.3839 11.3839C13.1495 11.6183 12.8315 11.75 12.5 11.75H11.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.25 9.25H3.75V14.25H11.25V9.25Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $fax; ?></span>
                    </div>
                <?php endif; ?>
                <?php if($email): ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path d="M2.5 3H12.5C13.1875 3 13.75 3.5625 13.75 4.25V11.75C13.75 12.4375 13.1875 13 12.5 13H2.5C1.8125 13 1.25 12.4375 1.25 11.75V4.25C1.25 3.5625 1.8125 3 2.5 3Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.75 4.25L7.5 8.625L1.25 4.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $email; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="pic" style=" line-height: 0; ">
            <?php echo $map; ?>
        </div>
    </a>
<?php else:  ?>
    <a class="contact-card" href="<?php echo $link; ?>" target="_blank">
        <div class="info">
            <h3><?php echo $place; ?></h3>
            <div class="divider"></div>
            <div class="address"><?php echo $address; ?></div>
            <div class="icon-list">
                <?php if($phone): ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                        <path d="M13.75 11.0751V12.9501C13.7507 13.1241 13.7151 13.2964 13.6453 13.4559C13.5756 13.6154 13.4733 13.7586 13.3451 13.8762C13.2168 13.9939 13.0654 14.0835 12.9005 14.1393C12.7356 14.195 12.5609 14.2157 12.3875 14.2001C10.4643 13.9911 8.61689 13.3339 6.99377 12.2813C5.48366 11.3217 4.20335 10.0414 3.24377 8.53131C2.18751 6.90081 1.53017 5.04443 1.32502 3.11256C1.3094 2.93973 1.32994 2.76554 1.38533 2.60108C1.44072 2.43662 1.52975 2.28549 1.64675 2.15732C1.76374 2.02916 1.90615 1.92675 2.06489 1.85664C2.22363 1.78652 2.39523 1.75022 2.56877 1.75006H4.44377C4.74709 1.74708 5.04114 1.85448 5.27112 2.05227C5.5011 2.25005 5.65132 2.52471 5.69377 2.82506C5.77291 3.4251 5.91968 4.01426 6.13127 4.58131C6.21536 4.80501 6.23356 5.04813 6.18371 5.28186C6.13386 5.51559 6.01806 5.73013 5.85002 5.90006L5.05627 6.69381C5.94599 8.25853 7.24155 9.55409 8.80627 10.4438L9.60002 9.65006C9.76995 9.48202 9.98449 9.36622 10.2182 9.31637C10.4519 9.26652 10.6951 9.28472 10.9188 9.36881C11.4858 9.5804 12.075 9.72717 12.675 9.80631C12.9786 9.84914 13.2559 10.0021 13.4541 10.236C13.6523 10.4699 13.7576 10.7685 13.75 11.0751Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $phone; ?></span>
                    </div>
                <?php endif; ?>
                <?php if($fax): ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path d="M3.75 6.125V1.75H11.25V6.125" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.75 11.75H2.5C2.16848 11.75 1.85054 11.6183 1.61612 11.3839C1.3817 11.1495 1.25 10.8315 1.25 10.5V7.375C1.25 7.04348 1.3817 6.72554 1.61612 6.49112C1.85054 6.2567 2.16848 6.125 2.5 6.125H12.5C12.8315 6.125 13.1495 6.2567 13.3839 6.49112C13.6183 6.72554 13.75 7.04348 13.75 7.375V10.5C13.75 10.8315 13.6183 11.1495 13.3839 11.3839C13.1495 11.6183 12.8315 11.75 12.5 11.75H11.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.25 9.25H3.75V14.25H11.25V9.25Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $fax; ?></span>
                    </div>
                <?php endif; ?>
                <?php if($email): ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path d="M2.5 3H12.5C13.1875 3 13.75 3.5625 13.75 4.25V11.75C13.75 12.4375 13.1875 13 12.5 13H2.5C1.8125 13 1.25 12.4375 1.25 11.75V4.25C1.25 3.5625 1.8125 3 2.5 3Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.75 4.25L7.5 8.625L1.25 4.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $email; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="link">
                <?php _e("ดูแผนที่ Google Map", "wpml_theme"); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none">
                <path d="M18.4186 4.38501H0.38776C0.17328 4.38501 0 4.21173 0 3.99725C0 3.78277 0.17328 3.60949 0.38776 3.60949H17.4819L15.1287 1.25627C14.9772 1.1048 14.9772 0.85882 15.1287 0.707351C15.2802 0.555883 15.5261 0.555883 15.6776 0.707351L18.6937 3.7234C18.8051 3.83488 18.8379 4.00089 18.7773 4.1463C18.7167 4.29049 18.5749 4.38501 18.4186 4.38501Z" fill="currentColor"/>
                <path d="M15.3989 7.40548C15.2996 7.40548 15.2002 7.36792 15.1251 7.29158C14.9736 7.14011 14.9736 6.89412 15.1251 6.74266L18.1448 3.72298C18.2962 3.57151 18.5422 3.57151 18.6937 3.72298C18.8451 3.87445 18.8451 4.12043 18.6937 4.2719L15.674 7.29158C15.5977 7.36792 15.4983 7.40548 15.3989 7.40548Z" fill="currentColor"/>
                </svg>
            </div>
        </div>
    </a>
<?php endif;  ?>
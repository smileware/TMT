<!-- TODO: Waiting for the animation -->

<?php 
    $title = get_field("product_title");
    $bg_default = get_field("product_bg_default");
    $bg_1 = get_field("product_bg_frame1");
    $bg_2 = get_field("product_bg_frame2");
    $bg_3 = get_field("product_bg_frame3");
?>

<style>
    .component .frame {
        display: none; /* Hide all frames initially */
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0; /* Initial opacity */
        transition: opacity 200ms ease-in-out; /* Smooth transition for fading in/out */
    }
    .component .frame.active {
        display: block; /* Show only the active frame */
        opacity: 1; /* Make frame visible */
    }

</style>
<div class="component">
    <h3><?php echo $title; ?></h3>
    <img src="<?php echo $bg_default; ?>" id="frame1" class="frame active" />
    <img src="<?php echo $bg_1; ?>" id="frame2" class="frame" />
    <img src="<?php echo $bg_2; ?>" id="frame3" class="frame" />
    <img src="<?php echo $bg_3; ?>" id="frame4" class="frame" />
</div>


<script>
function changeFrame(frameId, duration = 0, easing = 'ease-in-out') {
    const frames = document.querySelectorAll('.component .frame');
    frames.forEach(frame => {
        frame.style.transition = `opacity ${duration}ms ${easing}`;
    });

    document.getElementById(frameId).classList.add('active');
}

const component = document.querySelector('.component');

component.addEventListener('mouseenter', () => {
    changeFrame('frame2', 200, 'ease-in-out');
    setTimeout(() => changeFrame('frame3', 200, 'ease-in-out'), 50); // Overlapping transition
    setTimeout(() => changeFrame('frame4', 200, 'ease-in-out'), 250);
});

component.addEventListener('mouseleave', () => {
    changeFrame('frame3', 200, 'ease-in-out');
    setTimeout(() => changeFrame('frame2', 200, 'ease-in-out'), 50); // Overlapping transition
    setTimeout(() => changeFrame('frame1', 200, 'ease-in-out'), 250);
});


</script>
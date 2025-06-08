<style>
    a{
        text-decoration: underline;
        color: blue;
    }
</style>

<div class=" mx-3 my-6 break-words text-xs font-medium">
    <div class=" flex items-start  ">
        <div class="border min-w-8 min-h-8 rounded-full mx-2"></div>
        <div class=" w-9/10">
            <div>
                <span style="color: <?php echo $color ?>;"><?php echo $author ?></span>
                <span class="text-[9px] text-gray-600"><?php echo $timestamp ?></span> 
            </div>
            <p class=""><?php echo $messageWithLinks ?></p>
        </div>
    </div>
</div>
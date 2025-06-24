
<button class="w-full h-[65px] pl-5 p-3 flex justify-center hover:bg-yellow-100 rounded-md" 
    type="submit" name="room" value="<?=  htmlspecialchars($nameRoom) ?>">
    <p class="font-bold tracking-tighter flex justify-start items-center mr-auto"><span><?= htmlspecialchars($nameChat) ?></span></p>
    <!-- <div class=" text-xs flex justify-end items-start"> 12:33</div> -->
    <div id="unread-<?php echo $nameRoom ?>" class="flex justify-end items-center text-black p-0"></div>
</button>
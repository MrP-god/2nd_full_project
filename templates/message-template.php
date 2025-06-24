<style>
    a{
        text-decoration: underline;
        color: blue;
    }
    #dm{
        text-decoration: none;
        color: black;
        background: #eee;
        padding: 2px;
        padding-left: 5px;
        padding-right: 5px;
        font-size: 10px;
        border-radius: 4px;
    }
    #dm:hover{
        background-color: #93C5FD;
    }
</style>

<?php 


?>

<div class=" mx-3 my-6 break-words text-xs font-medium" data-message="true">
    <div class=" flex items-start  ">
        <div class="min-w-8 min-h-8 rounded-full mx-2 <?php echo getBgColor($author) ?> flex justify-center items-center font-bold">
            <?php echo $author[0] . $author[-1] ?>
        </div>
        <div class=" w-9/10">
            <div>
                <span style="color: <?php echo $color ?>;" class="text-md font-semibold"><?php echo $author ?></span>
                <span class="text-[9px] text-gray-600"><?php echo $timestamp ?></span> 
                <?php if($_SESSION["username"] !== "guest" && $author !== "guest" && $_SESSION["username"] !== $author):?>
                    <span>
                        <a id="dm" href="api/private-messages.php?user1=<?php echo $_SESSION['username']; ?>&user2=<?php echo $author; ?>" hx-trigger="click">Message</a>
                    </span>
                <?php endif; ?>
            </div>
            <p class="text-md font-bold"><?php echo $messageWithLinks ?></p>
        </div>
    </div>
</div>
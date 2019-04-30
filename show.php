<body id="forecast-extended" style="width: 605px;">
<? $days = unserialize(file_get_contents('cache_file')); ?><div id="feed-tabs" class="panel-list">
    <ul>
    <? foreach ($days as $k => $day): ?>    <li class="day fday<?=($k+1)?> hv<?if($k==0):?> current first<?endif;?>">
            <div class="bg bg-<?if($k==0):?>cl<?else:?>su<?endif;?>">
                <h3><a href="#"><?=$day['day']?></a></h3>
                <h4><?=$day['date']?></h4>
                <div class="<?=$day['image']?>"></div>
                <div class="info">
                    <div class="temp ">
                        <span class="large-temp"><?=$day['large_temp']?>°</span>
                        <span class="small-temp">/<?=$day['small_temp']?>°</span>
                    </div>
                    <span class="cond"><?=$day['cond']?></span>
                </div>
            </div>
        </li>
    <? endforeach; ?></ul>
</div>
<link href="slate.min-20190425-1001.css" rel="stylesheet" />
</body>
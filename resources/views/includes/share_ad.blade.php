<div class="d-flex px-2 share-ad">
    
    <!-- Your share button code -->
    <div>
    <div id="FBshareBtn" class="mr-3 fb-share-button" 
        title="Partager sur Facebook" style="cursor:pointer;">
            <i class="fa fa-facebook-f color-orange"></i>
    </div>
    </div>
    <div>
        <a class="mr-3"
        href="https://twitter.com/share?text={{$annonce->category}}: annonce sur yetecan &url={{route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}&hashtags=Guinée,yetecan,petitesannonces"
        data-via="yetecan" data-related="yetecan" target="_blank" title="Partager sur Twitter">
            <i class="fa fa-twitter color-orange"></i>
        </a>
    </div>
    <div>
        <a class="mr-3" href="https://www.linkedin.com/sharing/share-offsite/?url={{route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}" 
        title="Partager sur LinkedIn" target="_blank">
            <i class="fa fa-linkedin color-orange"></i>
        </a>
    </div>
    <div>
        <a class="mr-3" title="Partager sur Whatsapp" target="_blank" data-action="share/whatsapp/share"
        href="whatsapp://send?text={{route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}">
            <i class="fa fa-whatsapp color-orange"></i>
        </a>
    </div>
    <!--<div>
        <a class="mr-3" href="http://">
            <i class="fab fa-facebook-messenger"></i>
        </a>
    </div>-->
    <!--<div>
        <a class="mr-3" href="http://" title="Envoyer par Email">
            <i class="fa fa-envelope color-orange"></i>
        </a>
    </div>-->
</div>
$(document).ready(function(){
    $(window).ready(function(){

        var isVisible1 = 0;
        var isVisible2 = 0;
        var isVisible3 = 0;
        var isVisible4 = 0;
        var isVisible5 = 0;
        var marginRight = 0;

        if ($(window).innerWidth() > 883)
        {
            marginRight = $(".footerContainer").innerWidth() - ($(".quickLinks").innerWidth() + $(".socialIcons").innerWidth() + $(".newsLetters").innerWidth());
            marginRight = marginRight/2;
            $(".quickLinks").css("margin-right", marginRight+"px");
            $(".socialIcons").css("margin-right", marginRight+"px");
        }
        else
        {
            $(".quickLinks").css("margin-right", "0");
            $(".socialIcons").css("margin-right", "0");
        }



        if ($(window).innerWidth() > 768)
        {
            $(".hiddenMenu").css({
                "display": "none",
                "top": "100%"
            })
            isVisible5 = 0;
        }

        $(".mainHeading, #hiddenHomeOptn").on("click", function(){
            window.location = "home.php";
        })

        $(".cartOptn, .hiddenCartOption").on("click", function(){

            if ($(window).innerWidth() > 480)
            {
                $(".cover").fadeIn();
            }
            else
            {
                $("body").css("overflow", "hidden");
            }
            $(".cart").fadeIn();

        })

        $(".close").on("click", function(){

            $(".cover").fadeOut();
            $(".cart").fadeOut();
            $("body").css("overflow", "auto");

        })

        $(window).on("resize", function(){

           // $(".cart").css("display", "none");
            //$(".cover").css("display", "none");
            $("body").css("overflow", "auto");

            if ($(window).innerWidth() > 768)
            {
                $(".hiddenMenu").css({
                    "display": "none",
                    "top": "100%"
                })
            }
            isVisible5 = 0;

            if ($(window).innerWidth() > 883)
            {
                marginRight = $(".footerContainer").innerWidth() - ($(".quickLinks").innerWidth() + $(".socialIcons").innerWidth() + $(".newsLetters").innerWidth());
                marginRight = marginRight/2;
                $(".quickLinks").css("margin-right", marginRight+"px");
                $(".socialIcons").css("margin-right", marginRight+"px");
            }
            else
            {
                $(".quickLinks").css("margin-right", "0");
                $(".socialIcons").css("margin-right", "0");
            }

        })

        $("#deskmac").on("click", function(){

            if (isVisible2 == 1)
            {
                $("#lapbook").find(".hiddenSubMenu").css("display", "none");
                isVisible2 = 0;
            }

            if (isVisible1 == 0)
            {
                $("#deskmac").find(".hiddenSubMenu").css("display", "block");
                isVisible1 = 1;
            }
            else
            {
                $("#deskmac").find(".hiddenSubMenu").css("display", "none");
                isVisible1 = 0;
            }

        })

        $("#lapbook").on("click", function(){

            if (isVisible1 == 1)
            {
                $("#deskmac").find(".hiddenSubMenu").css("display", "none");
                isVisible1 = 0;
            }

            if (isVisible2 == 0)
            {
                $("#lapbook").find(".hiddenSubMenu").css("display", "block");
                isVisible2 = 1;
            }
            else
            {
                $("#lapbook").find(".hiddenSubMenu").css("display", "none");
                isVisible2 = 0;
            }

        })

        $("#hiddenDeskMac").on("click", function(){

            if (isVisible3 == 0)
            {
                $("#hiddenDeskMacSub").slideDown(300, function(){
                    isVisible3 = 1;
                });
                isVisible3 =  2;
            }
            else if (isVisible3 == 1)
            {
                $("#hiddenDeskMacSub").slideUp(300, function(){
                    isVisible3 = 0;
                });
                isVisible3 =  2;
            }

        })

        $("#hiddenLapMac").on("click", function(){

            if (isVisible4 == 0)
            {
                $("#hiddenLapMacSub").slideDown(300, function(){
                    isVisible4 = 1;
                });
                isVisible4 =  2;
            }
            else if (isVisible4 == 1)
            {
                $("#hiddenLapMacSub").slideUp(300, function(){
                    isVisible4 = 0;
                });
                isVisible4 =  2;
            }

        })

        $(".hiddenMenuOption").on("click", function(){

            if (isVisible5 == 0)
            {
                $(".hiddenMenu").css("display", "block");

                $(".hiddenMenu").animate({
                    "top": "50px"
                },
                {
                    duration: 300,
                    complete: function()
                    {
                        isVisible5 = 1;
                    }
                })
                isVisible5 = 2;
            }
            else if (isVisible5 == 1)
            {
                $(".hiddenMenu").animate({
                    "top": "100%"
                },
                {
                    duration: 300,
                    complete: function()
                    {
                        isVisible5 = 0;
                        $(".hiddenMenu").css("display", "none");
                    }
                })
                isVisible5 = 2;
            }

        })

        
        $(".plus, .minus").on("click", function(){

            var thisId = $(this).parent().parent().parent().attr("id");
            var thisClass = $(this).attr("class");
            var currentQuant = $("#"+thisId).find(".quantText").text();
            currentQuant = parseInt(currentQuant);

            var formData = new FormData();
            formData.append("cartId", thisId);
            formData.append("currQuant", currentQuant);
            formData.append("op", thisClass);

            var xhr = new XMLHttpRequest();
            xhr.open("POST","setQuantity.php");

            xhr.onreadystatechange = function()
            {
                var done = 4;
                var ok = 200;

                if (xhr.readyState == done)
                {
                    if (xhr.status == ok)
                    {
                        var res = xhr.responseText;
                        res = JSON.parse(res);

                        if (res["errorCode"] == 2)
                        {
                            if (thisClass == "plus")
                            {
                                var newQuant = currentQuant + 1;
                            }
                            else if (thisClass == "minus" && currentQuant > 1)
                            {
                                var newQuant = currentQuant - 1;
                            }
                            else
                            {
                                var newQuant = currentQuant;
                            }
                            $("#"+thisId).find(".quantText").text(newQuant);
                        }
                    }
                }
            }

            xhr.send(formData);
           
        })

        $(".removeProduct").on("click", function(){

            var thisId = $(this).parent().attr("id");

            var formData = new FormData();
            formData.append("cartId", thisId);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "removeFormCart.php");

            xhr.onreadystatechange = function()
            {
                var done = 4;
                var ok = 200;

                if (xhr.readyState == done)
                {
                    if (xhr.status == ok)
                    {
                        var res = xhr.responseText;
                        console.log(res);
                        res = JSON.parse(res);

                        if (res["errorCode"] == 2)
                        {
                            $("#"+thisId).fadeOut(function(){
                                $("#"+thisId).remove();
                            })
                        }
                    }
                }
            }

            xhr.send(formData);

        })

        $(".searchIcon").on("click", function(){

            var searchQuery = $("#searchQuery").val();
            searchQuery = searchQuery.trim();
            
            if (searchQuery)
            {
                window.location = "search.php?query="+searchQuery;
            }
        })

         $(".hiddenSearchIcon").on("click", function(){

            var searchQuery = $("#hiddenSearchQuery").val();
            searchQuery = searchQuery.trim();
            
            if (searchQuery)
            {
                window.location = "search.php?query="+searchQuery;
            }
        })

        $(".checkoutBtn").on("click", function(){
            window.location = "selectAddress.php";
        })
    })
})

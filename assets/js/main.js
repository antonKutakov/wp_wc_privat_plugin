(function($){

    /**
     * Ajax statements for settings
     */
    $("#pp-settings-form").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: $("#pp-settings-form").serialize() + "&action=save_settings",
            beforeSend: function(){
                $(".pp-preloader").css({'display' : 'flex'});
            },
            complete: function(){
                $(".pp-preloader").css({'display' : 'none'});
            },
            success: function(resp){
                console.log(JSON.parse(resp));
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    })

    /**
     * Ajax query for statements
     */
    $("#pp-statements-form").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: $("#pp-statements-form").serialize() + "&action=take_statements&security=" + ajaxurl.ajax_nonce,
            beforeSend: function(){
                empty_parent(".pp-statement-content", ".pp-statement-content-item");
                
                empty_parent(".pp-status", "p");
                empty_parent(".pp-credit", "p");
                empty_parent(".pp-debet", "p");

                $(".pp-preloader").css({'display' : 'flex'});
            },
            complete: function(){
                $(".pp-preloader").css({'display' : 'none'});
            },
            success: function(resp){
                if(JSON.parse(resp).code != 200){
                    $(".pp-preloader").css({'display' : 'none'});
                    if($(".pp-statement-content").has(".pp-statement-content-item")){
                        $(".pp-statement-content").empty();
                    }
                    $(".pp-error-handler").css({'display' : 'flex'});
                    $(".pp-error-handler-text-block p").append(JSON.parse(resp).message);
                }
                else{
                    console.log(resp)
                    render_statements(JSON.parse(resp).data);
                    render_meta_statements(JSON.parse(resp).data);
                }
            },
            error: function(errorThrown){
                $(".pp-preloader").css({'display' : 'none'});
            }
        });
    });

    $(document).click(function(){
        $(".pp-error-handler").css({'display' : 'none'});
        $(".pp-error-handler-text-block p").empty();
    })

    /**
     * Render statements
     * 
     * @param {json} resp 
     */
    function render_statements(resp){
        var statements = JSON.parse(resp);
        var statements_count = Object.keys(statements.statement).length;

        empty_parent(".pp-statement-content", ".pp-statement-content-item");

        for(var i = 0; i < statements_count; i++){
            var content = "<div class='pp-statement-content-item'>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].card + "</p>";
                content += "</div>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].trandate + "/" + statements.statement[i]['@attributes'].trantime +"</p>";
                content += "</div>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].amount + "</p>";
                content += "</div>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].cardamount + "</p>";
                content += "</div>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].rest + "</p>";
                content += "</div>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].terminal + "</p>";
                content += "</div>";
                content += "<div class='pp-statement-content-item-value'>";
                    content += "<p>" + statements.statement[i]['@attributes'].description + "</p>";
                content += "</div>";
            content += "</div>";

            render_content(".pp-statement-content", content);
        }
        
    }

    /**
     * Empty parent block
     * 
     * @param {string} parent_block 
     * @param {string} child_block 
     */
    function empty_parent(parent_block = '', child_block = ''){
        if($(parent_block).has(child_block)){
            $(parent_block).empty();
        }
    }

    /**
     * Render meta data of statements
     * 
     * @param {json} resp 
     */
    function render_meta_statements(resp){
        var meta_statements = JSON.parse(resp);

        empty_parent(".pp-status", "p");
        empty_parent(".pp-credit", "p");
        empty_parent(".pp-debet", "p");


        var status = meta_statements['@attributes'].status;
        var credit = meta_statements['@attributes'].credit;
        var debet = meta_statements['@attributes'].debet;

        var content_status = "<p>" + status.capitalize() + "</p>";
        var content_credit = "<p>" + credit + "</p>";
        var content_debet = "<p>" + debet + "</p>";

        render_content(".pp-status", content_status);
        render_content(".pp-credit", content_credit);
        render_content(".pp-debet", content_debet);
    }

    $("#pp-balance-form").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: $("#pp-balance-form").serialize() + "&action=take_balance",
            beforeSend: function(){
                $(".pp-preloader").css({'display' : 'flex'});
            },
            complete: function(){
                $(".pp-preloader").css({'display' : 'none'});
            },
            success: function(resp){
                if(JSON.parse(resp).code != 200){
                    $(".pp-preloader").css({'display' : 'none'});
                    $(".pp-error-handler").css({'display' : 'flex'});
                    $(".pp-error-handler-text-block p").append(JSON.parse(resp).message);
                }  else{
                    console.log(JSON.parse(resp).data);
                    render_balance(JSON.parse(resp).data);
                }

            },
            error: function(errorThrown){
                console.log(errorThrown);
                console.warn(errorThrown.responseText);
            }
        });
    });

    function render_balance(resp){
        var balances = JSON.parse(resp);
        var content = "<div class='pp-balance-content-item'>";

        empty_parent(".pp-balance-content", ".pp-balance-content-item");
        
            content += "<div class='pp-balance-content-item-value'>";
                content += "<p>" + balances.card.card_number + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
                content += "<p>" + balances.bal_date + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
                content += "<p>" + balances.card.account + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
                content += "<p>" + balances.av_balance + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
                content += "<p>" + balances.balance + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
                content += "<p>" + balances.card.currency + "</p>";
            content += "</div>";
        content += "</div>";

        render_content(".pp-balance-content", content);

    }

    $("#pp-balance-form-archive").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: $("#pp-balance-form-archive").serialize() + "&action=take_balance_arch",
            beforeSend: function(){
                $(".pp-preloader-archive").css({'display' : 'flex'});
            },
            complete: function(){
                $(".pp-preloader-archive").css({'display' : 'none'});
            },
            success: function(resp){
                if(JSON.parse(resp).code != 200){
                    console.log($("#pp-balance-form-archive").serialize());
                    $(".pp-preloader").css({'display' : 'none'});
                    $(".pp-error-handler-archive").css({'display' : 'flex'});
                    $(".pp-error-handler-text-block-archive p").append(JSON.parse(resp).message);
                }  else{
                    console.log(resp);
                    render_balance_arch(JSON.parse(resp).data);
                }

            },
            error: function(errorThrown){
                console.log(errorThrown);
                console.warn(errorThrown.responseText);
            }
        });
    });

    function render_balance_arch(resp){
        var balances = JSON.parse(resp);
        var balances_count = Object.keys(balances).length;

        empty_parent(".pp-balance-content-arch", ".pp-balance-content-item");

         for(var i = 0; i < balances_count; i++) {
             var content = "<div class='pp-balance-content-item'>";
            content += "<div class='pp-balance-content-item-value'>";
            content += "<p>" + balances[i].card_number + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value item-date'>";
            content += "<p>" + balances[i].bal_date  + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
            content += "<p>" + balances[i].account  + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
            content += "<p>" + balances[i].av_balance  + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
            content += "<p>" + balances[i].balance + "</p>";
            content += "</div>";
            content += "<div class='pp-balance-content-item-value'>";
            content += "<p>" + balances[i].currency + "</p>";
            content += "</div>";
            content += "</div>";
            render_content(".pp-balance-content-arch", content);
        }
    }

    /**
     * Render html content with appending to parent element
     * 
     * @param {string} append_to 
     * @param {string} content 
     */
    function render_content(append_to = '', content = ''){
        $(append_to).append(content);
    }

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }

})(jQuery)

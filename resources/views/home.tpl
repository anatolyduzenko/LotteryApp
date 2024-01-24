{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
	<h1 class="form-signin-heading">Welcome to the Lottery!</h1>
    <p>Click on the image to enter!</p>
    <div id="lottery-container">
        <div id="spinner">
            {if $guest}
                <img class="" src="/images/spinner-win.png" />
            {else}
                <a href="{route('member.lottery')}">
                    <img class="" src="/images/spinner-win.png" />
                </a>
            {/if}
        </div>
        {if $guest }   
            <h2 class="py-3">
                <a class="btn btn-lg btn-primary" href="{route('register')}">Register</a>
                or 
                <a class="btn btn-lg btn-primary" href="{route('login')}">Login</a>
                now and Try Your Luck!
            </h2>
        {/if}
    </div>
{/block}
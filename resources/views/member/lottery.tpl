{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
	<h1 class="form-signin-heading">register</h1>
    <div id="lottery-container">
        <div id="spinner">
            {* Spinner placeholder *}
        </div>
        <table id="results-table">
            <thead>
                <tr>
                    <th>Winner Name</th>
                    <th>Amount Won</th>
                </tr>
            </thead>
            <tbody>
                {* Loop through winners data *}
                {foreach from=$winners item=winner}
                    <tr>
                        <td>{$winner.name}</td>
                        <td>{$winner.amount}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}
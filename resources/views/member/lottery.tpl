{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
    
    <h1 class="form-signin-heading py=10">Spin the Fortune wheel!</h1>
    {if $next_draw_time}
        <h2>
            Next lottery round starts in
            <!-- {$next_draw_time}  -->
            <span class="tl-h"></span> Hours 
            <span class="tl-m"></span> Minutes 
            <span class="tl-s"></span> Seconds
        </h2>
    {/if}
    {foreach from=$errors->all() item=error} 
        <div class="alert alert-danger">
            {$error}
        </div>
    {/foreach}
    <form method="post" action="{route('member.placeticket')}">
        <legend>You can add your tickets here.</legend>
        <label for="date">Drawing Date:</label>
        <input type="date" name="date" id="date" required></input>    
        <label for="ticket_number">Ticket Number:</label>
        <input type="text" name="ticket_number" id="ticket_number" required></input>
        {$csrf_field}
        <button type="submit" class="btn btn-primary btn-md" id="get-my-luck">Register Ticket!</button>
    </form>
    
    <div>- or -</div>
    <a class="btn btn-success btn-lg" href="{route('member.winners')}">Check the results</a>
    <div id="lottery-container">
        <div id="spinner" class="animated">
            <!-- img class="" src="/images/spinner.png" --/ -->
        </div>
        <hr/>
        {if $tickets|@count gt 0}
            <h2>My upcoming tickets!</h2>
            <table id="results-table" class="table table-bordered table-hover table-light table-sm w-100">
                <thead>
                    <tr>
                        <th>Drawing Date</th>
                        <th>Ticket Number</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$tickets item=ticket}
                        <tr>
                            <td>{$ticket.drawing_date|date_format: '%d/%m/%Y'}</td>
                            <td>{$ticket.number}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>    
        {else}
            <div class="">
                <h1>You don't have any upcoming tickets!</h1>
            </div>
        {/if}
    </div>
{/block}
{block name=scripts}
    <script type="text/javascript" >
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            window.targetDate = {$next_draw_time};
            window.targetLocation = '{route('member.winners')}';
            // Bounce
            $('#get-my-luck').click(function() {
                $('#spinner').addClass('bounce');
            });
        });
    </script>
    <script src="/js/timer.js"></script>
{/block}
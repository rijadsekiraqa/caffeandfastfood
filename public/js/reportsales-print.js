
    $(document).ready(function(){
    $('#report-list td,#report-list th').addClass('py-1 px-2 align-middle')
    $('#print').click(function(){
    var head = $('head').clone()
    var p = $($('#printout').html()).clone()
    var phead = $($('noscript#print-header').html()).clone()
    var el = $('<div class="container-fluid">')
    head.find('title').text("Daily Sales Report-Print View")
    el.append(phead)
    el.append(p)
    el.find('.bg-gradient-navy').css({'background':'#001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important','color':'#fff'})
    el.find('.bg-gradient-secondary').css({'background':'#6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important','color':'#fff'})
    el.find('tr.bg-gradient-navy').attr('style',"color:#000")
    el.find('tr.bg-gradient-secondary').attr('style',"color:#000")
    start_loader();
    var nw = window.open("", "_blank", "width=1000, height=900")
    nw.document.querySelector('head').innerHTML = head.prop('outerHTML')
    nw.document.querySelector('body').innerHTML = el.prop('outerHTML')
    nw.document.close()
    setTimeout(()=>{
    nw.print()
    setTimeout(()=>{
    nw.close()
    end_loader()
},300)
},500)
})
})


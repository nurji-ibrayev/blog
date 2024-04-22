/* jshint esversion: 6 */
let hidden_menu = document.getElementById('hidden_menu');
let desktop_menu = document.getElementById('desktop_menu');
let mobile_menu = document.getElementById('mobile_menu');
let account_corner = document.getElementById('account_corner');
let fullscreen_image = document.getElementById('fullscreen_image');
let last_scroll = window.pageYOffset;
let slideshow_image = document.getElementById('slideshow_image');
let slide_index = 0;
let top_link = document.getElementById('top_link');

const slide_images =
    [
        '/images/slideshow_001.webp',
        '/images/slideshow_002.webp',
        '/images/slideshow_003.webp',
        '/images/slideshow_004.webp'
    ];

window.onload = function()
{
    hidden_menu = document.getElementById('hidden_menu');
    desktop_menu = document.getElementById('desktop_menu');
    mobile_menu = document.getElementById('mobile_menu');
    account_corner = document.getElementById('account_corner');
    fullscreen_image = document.getElementById('fullscreen_image');
    slideshow_image = document.getElementById('slideshow_image');
    top_link = document.getElementById('top_link');

    if(window.pageYOffset == 0)
    {
        // focus go_top button when it on top and blur when else
        top_link.style.display = 'none';

        // activate current navigation menu link
        if(document.getElementsByClassName('container').length > 1)
        {
            document.getElementById('home_link').className = 'active';
        }
        else
        {
            document.getElementById(window.location.href.replace('https://eyeball.kz/', '').replace('/', '') + '_link').className = 'active';
        }
    }

    // start to show slides
    Show_slides();
};

window.onscroll = function()
{
    // activate navigation menu when scrolling and push current page to history
    Scroll_navigation();

    // hide header when scrolling down and show it when scrolling up
    Hide_header();

    // hide go_top button when it on top and show when else
    if(window.pageYOffset == 0)
    {
        top_link.style.display = 'none';
    }
    else
    {
        top_link.style.display = '';
    }
}

// hide navigation menu on mobile platforms and show it on desktops
window.onresize = function()
{
    if(window.innerWidth > 1080)
    {
        Hide_menu(false);
    }
    else if(window.innerWidth <= 1080)
    {
        Hide_menu(true);
    }
};

// scroll navigation links when scrolling page
function Scroll_navigation()
{
    const links = desktop_menu.getElementsByTagName('a');
    const containers = document.getElementsByClassName('container');

    for (let i = 0; i < containers.length; i++)
    {
        const current_position = window.scrollY;
        const offset = containers[i].offsetTop - desktop_menu.offsetHeight;

        if(current_position >= offset && current_position < offset + containers[i].offsetHeight && containers.length > 1)
        {
            // inactivate all navigation links except the current link
            for(let j = 0; j < links.length; j++)
            {
                if(links[j].id != (containers[i].id + '_link'))
                {
                    links[j].className = '';
                }
            }

            // activate current navigation link
            document.getElementById(containers[i].id + '_link').className = 'active';

            // changing url and title
            let translated_text = Translate_text(containers[i].id);
            if(containers[i].id == 'home')
            {
                history.pushState(null, 'EyeBall.kz - Ваш незаменимый спутник в ритме современной жизни', '/');
                document.title = 'EyeBall.kz - Ваш незаменимый спутник в ритме современной жизни';
            }
            else
            {
                history.pushState(null, 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1), '/' + containers[i].id);
                document.title = 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1);
            }
        }
    }
}

// scroll page to target block when navigation link clicked
function Scroll_page(container_name)
{
    const containers = document.getElementsByClassName('container');

    // scrolling to target block
    for (let i = 0; i < containers.length; i++)
    {
        if(containers[i].id == container_name)
        {
            containers[i].scrollIntoView();

            // cancel hiding header when scrolling to target block
            setTimeout(function()
            {
                mobile_menu.style.transform = 'none';
                desktop_menu.style.transform = 'none';
                account_corner.style.transform = 'none';
            }, 100);
        }
        else
        {
            console.log(document.getElementById(container_name).id);
        }
    }

    // hiding navigation menu on mobile platforms when clicking on a navigation link
    if(window.innerWidth <= 1080)
    {
        Hide_menu(true);
    }

    // changing url and title during scrolling when block is reached
    let translated_text = Translate_text(container_name);

    history.pushState(null, 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1), '/' + container_name);
    document.title = 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1);
}

// hide header when scrolling down and show it when scrolling up
function Hide_header()
{
    const current_scroll = window.pageYOffset;

    if(last_scroll > current_scroll)
    {
        mobile_menu.style.transition = 'transform 100ms ease-in-out';
        mobile_menu.style.transform = 'none';

        desktop_menu.style.transition = 'transform 100ms ease-in-out';
        desktop_menu.style.transform = 'none';

        account_corner.style.transition = 'transform 100ms ease-in-out';
        account_corner.style.transform = 'none';
    }
    else
    {
        if(window.innerWidth <= 1080)
        {
            mobile_menu.style.transition = 'transform 500ms ease-in-out';
            mobile_menu.style.transform = 'translateY(-15.3vw)';

            Hide_menu(true);
        }
        else
        {
            mobile_menu.style.transition = 'transform 500ms ease-in-out';
            mobile_menu.style.transform = 'translateY(-50px)';

            desktop_menu.style.transition = 'transform 500ms ease-in-out';
            desktop_menu.style.transform = 'translateY(-50px)';

            account_corner.style.transition = 'transform 500ms ease-in-out';
            account_corner.style.transform = 'translateY(-50px)';
        }

    }

    last_scroll = current_scroll;
}

function Load_page(file_name)
{
    const content_file = new XMLHttpRequest();
    content_file.open('GET', '../contents/' + file_name + '.php', true);
    content_file.onreadystatechange = function()
    {
        let translated_text = Translate_text(file_name);

        // changing page content, url and title
        if (content_file.readyState == 4 && content_file.status == 200)
        {
            document.getElementById('container').innerHTML = content_file.responseText;

            history.pushState(null, 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1), '/' + file_name);
            document.title = 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1);
        }
        else
        {
            document.getElementById('container').innerHTML = '<h2>Error: ' + content_file.status + '</h2>';

            history.pushState(null, 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1), '/' + file_name);
            document.title = 'EyeBall.kz - ' + translated_text.slice(0, 1).toUpperCase() + translated_text.slice(1);
        }
    };
    content_file.send(null);
}

// translate text from english to russian using google translator
function Translate_text(text)
{
    const translate_url = 'https://translate.googleapis.com/translate_a/single?format=text&client=gtx&sl=' + 'en' + '&tl=' + 'ru' + '&dt=t&q=' + text;
    // sl – язык оригинала, tl – язык для перевода, text – текст запроса

    const http_request = new XMLHttpRequest();
    http_request.open("GET", translate_url, false);
    http_request.send(null);

    const http_response = JSON.parse(http_request.responseText);
    let translated_text = '';

    http_response.forEach(function(response_element)
    {
        translated_text += response_element;
    });

    return translated_text.split(",")[0];
}

// hide or display navigation menu links
function Hide_menu(status)
{
    if(status)
    {
        desktop_menu.style.display = 'none';

        hidden_menu.title = "Показать навигацию";
        hidden_menu.blur();

        account_corner.style.display = 'none';
    }
    else
    {
        desktop_menu.style.display = 'block';
        hidden_menu.title = "Скрыть навигацию";

        account_corner.style.display = 'block';
    }
}

// display fulscreen image block and set background image source for it when clicking on image
function Fullscreen_image(url)
{
    fullscreen_image.style.display = 'block';
    fullscreen_image.style.backgroundImage = 'url(' + url + ')';
}

// start to show slides
function Show_slides()
{
    // handling if slide index reached the end
    if(slide_index >= slide_images.length)
    {
        slide_index = 0;
    }

    // setting slide image source
    try
    {
        slideshow_image.src = slide_images[slide_index];

        // setting background color for all slide dotes
        for(let i = 0; i < slide_images.length; i++)
        {
            const dot_instance = document.getElementById('dot_' + i);

            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
            {
                dot_instance.style.background = '#808080';
            }
            else
            {
                dot_instance.style.background = '#E3E3E3';
            }
        }

        // setting background color for current slide dot
        const dot_instance = document.getElementById('dot_' + slide_index);
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
        {
            dot_instance.style.background = '#E3E3E3';
        }
        else
        {
            dot_instance.style.background = '#808080';
        }
    }
    catch {}

    // changing slide index to the next
    slide_index = slide_index + 1;

    // setting timeout for slide
    setTimeout(Show_slides, 3000);
}

// change the slide index
function Slide_clicked(clicked_index)
{
    // setting background color for all slide dotes
    for(let i = 0; i < slide_images.length; i++)
    {
        const dot_instance = document.getElementById('dot_' + i);

        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
        {
            dot_instance.style.background = '#808080';
        }
        else
        {
            dot_instance.style.background = '#E3E3E3';
        }
    }

    // handling slide index if it's reached the end or it's below zero
    if(clicked_index >= slide_images.length)
    {
        slide_index = 0;
    }
    else if(clicked_index < 0)
    {
        slide_index = slide_images.length - 1;
    }
    else
    {
        slide_index = clicked_index;
    }

    // setting background color for clicked slide dot
    const dot_instance = document.getElementById('dot_' + slide_index);
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
    {
        dot_instance.style.background = '#E3E3E3';
    }
    else
    {
        dot_instance.style.background = '#808080';
    }

    // changing slide image source to clicked
    slideshow_image.src = slide_images[slide_index];
}

// scroll page to top
function Go_top()
{
    // for Safari
    document.body.scrollTop = 0;

    // for other browsers
    window.scrollTo({top: 0, behavior: 'smooth'});
}

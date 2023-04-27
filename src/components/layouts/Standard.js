import {Link} from 'gatsby'
import React from 'react'
import Navbar from '../Navbar'
import SEO from '../SEO'
import { PopupText } from "react-calendly"
import '../../styles/global.css'

export default function LayoutStandard({children}){
	
  return (

  		<div className="layout layout-standard">

        <SEO />

        <Navbar/>

        <main className="content">

            { children }

        </main>

        <footer>

          <div className="container">

            <div className="row">

              <div className="col-5">

                <p className="title">When you need a SaaS site that converts, start with clarity.</p>

              </div>

              <div className="col-1"></div>

              <div className="col-3">

                <p className="subtitle">About</p>

                <ul class="footer-menu">
                  <li><Link to="/story">Story</Link></li>
                  <li><Link to="/process">Process</Link></li>
                  <li><Link to="/podcast-appearances">Podcast Appearances</Link></li>
                </ul>

              </div>

              <div className="col-3">

                <p className="subtitle">Company</p>

                <ul class="footer-menu">
                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>
                  <li><PopupText url="https://calendly.com/kbs-marc/hello" text="Let's Talk"></PopupText></li>

                  <li id="social-links"><a href="https://www.youtube.com/@demystifying-design" target="_blank"><svg width="auto" height="auto" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.1823 2.53011C17.9683 1.7306 17.3399 1.1023 16.5404 0.888288C15.0928 0.5 9.28525 0.5 9.28525 0.5C9.28525 0.5 3.47777 0.5 2.0301 0.888288C1.2306 1.1023 0.602305 1.7306 0.388288 2.53011C1.16229e-07 3.97777 0 7 0 7C0 7 1.16229e-07 10.0222 0.388288 11.4699C0.602305 12.2694 1.2306 12.8977 2.0301 13.1117C3.47777 13.5 9.28525 13.5 9.28525 13.5C9.28525 13.5 15.0928 13.5 16.5404 13.1117C17.3399 12.8977 17.9683 12.2694 18.1823 11.4699C18.5706 10.0222 18.5706 7 18.5706 7C18.5706 7 18.569 3.97777 18.1823 2.53011Z" fill="white"/><path d="M7.42676 9.78539L12.2513 7.00014L7.42676 4.21484V9.78539Z" fill="#0C1A31"/></svg></a><a style={{height: 20}} href="https://www.linkedin.com/in/marc-mcdougall/" target="_blank"><svg width="auto" height="auto" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.570801 1.57451C0.570801 0.981233 1.06394 0.5 1.67228 0.5H14.3747C14.9831 0.5 15.4762 0.981233 15.4762 1.57451V14.4255C15.4762 15.019 14.9831 15.5 14.3747 15.5H1.67228C1.06394 15.5 0.570801 15.019 0.570801 14.4255V1.57451Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M5.0895 13.0566V6.2833H2.83816V13.0566H5.0895ZM3.96382 5.35852C4.7489 5.35852 5.23756 4.8384 5.23756 4.1884C5.22292 3.52378 4.74891 3.01809 3.97871 3.01809C3.2086 3.01809 2.70508 3.52378 2.70508 4.1884C2.70508 4.8384 3.19362 5.35852 3.94915 5.35852H3.96382Z" fill="#0C1A31"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.33496 13.0566H8.58627V9.27412C8.58627 9.07169 8.6009 8.86945 8.66035 8.72474C8.8231 8.32027 9.19354 7.90137 9.81547 7.90137C10.6301 7.90137 10.956 8.52251 10.956 9.43306V13.0566H13.2071V9.1729C13.2071 7.09244 12.0964 6.12436 10.6152 6.12436C9.40072 6.12436 8.86753 6.80322 8.5713 7.26561H8.58633V6.2833H6.33502C6.36457 6.91887 6.33496 13.0566 6.33496 13.0566Z" fill="#0C1A31"/></svg>
</a><a href="https://github.com/marcjmcdougall" target="_blank"><svg width="auto" height="auto" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_96_3861)"><path d="M6.94275 0.659956C4.90942 1.11329 3.24275 2.23996 2.09609 3.94662C0.0894203 6.95329 0.48942 10.9866 3.04942 13.56C3.81609 14.3333 4.98275 15.08 5.86275 15.3666C6.18942 15.4733 6.22942 15.4733 6.37609 15.3733C6.53609 15.2666 6.54275 15.24 6.54275 14.4733V13.6866L5.95609 13.72C5.26942 13.7533 4.73609 13.6333 4.41609 13.36C4.30275 13.2666 4.08275 12.9466 3.92942 12.6533C3.67609 12.16 3.48942 11.9333 2.96942 11.4733C2.79609 11.32 2.78942 11.3133 2.90942 11.2266C3.19609 11.0133 3.77609 11.22 4.14275 11.66C4.78275 12.44 5.02942 12.6466 5.39609 12.7266C5.72275 12.7933 6.02275 12.7666 6.47609 12.6333C6.53609 12.6133 6.61609 12.4733 6.65609 12.3133C6.69609 12.16 6.80275 11.9266 6.88942 11.8L7.04942 11.5666L6.50942 11.46C5.37609 11.2266 4.67609 10.82 4.21609 10.1266C3.78942 9.48662 3.64942 8.93329 3.64275 7.89996C3.64275 6.92662 3.74942 6.52662 4.16942 5.97996C4.35609 5.73996 4.37609 5.66662 4.32275 5.52662C4.22275 5.28662 4.24942 4.27329 4.35609 3.96662C4.44275 3.73996 4.48942 3.69996 4.66942 3.67996C4.96942 3.64662 5.52942 3.83996 6.09609 4.15996L6.58275 4.43996L7.00942 4.33996C7.61609 4.19996 9.43609 4.20662 9.98275 4.33996L10.3961 4.44662L10.7828 4.21329C11.2961 3.90662 11.9494 3.66662 12.2761 3.66662C12.5361 3.66662 12.5361 3.67329 12.6428 4.01329C12.7561 4.40662 12.7761 5.11996 12.6761 5.45996C12.6228 5.65996 12.6361 5.71996 12.7828 5.91329C13.5094 6.87329 13.5894 8.46662 12.9761 9.77329C12.5628 10.6333 11.6894 11.2333 10.5161 11.4533L9.95609 11.56L10.1628 11.9266L10.3761 12.3L10.3961 13.7866L10.4228 15.2733L10.5894 15.38C10.7428 15.48 10.7761 15.48 11.0961 15.3666C11.6294 15.1866 12.5428 14.6933 13.0428 14.3133C16.0161 12.0866 16.9761 8.09329 15.3294 4.77329C14.3628 2.81996 12.5361 1.31996 10.4428 0.759956C9.52942 0.519957 7.80942 0.466623 6.94275 0.659956Z" fill="white"/></g><defs><clipPath id="clip0_96_3861"><rect width="16" height="16" fill="white" transform="translate(0.476074)"/></clipPath></defs></svg>
</a></li>

                </ul>

              </div>

            </div>

            <div id="attribution" className="row">

              <div className="col-6">
                
                <p>© {(new Date().getFullYear())} Kilobyte Studios, LLC.</p>

              </div>

              <div id="functional" className="col-6">
                
                <a href="/" target="_blank">Built with Function.al<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg></a>

              </div>

            </div>

          </div>

        </footer>

      </div>
  	)
}

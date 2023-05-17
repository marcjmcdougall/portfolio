import { StaticQuery, graphql, Link } from 'gatsby'
import React, { useState } from "react"
import Img from "gatsby-image"
import { PopupText } from "react-calendly"
import externalIcon from '../img/arrow-right-up.svg';
import favicon from '../img/favicon.png';
import { StaticImage } from "gatsby-image"

export default function Navbar({ data }) {

  const [open, setOpen] = useState(false);

  return (

      <StaticQuery

        query={graphql`query {
          file(relativePath: {eq: "signature.jpg"}) {
            childImageSharp {
              fluid(maxWidth: 200) {
                ...GatsbyImageSharpFluid
              }
            }
          }
        }`}

        render={data => (

           <nav id="main-nav" className="container">

            <div className="row">

              <div className="col-6">
                
                <ul className='desktopMenu'> 

                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>

                </ul>

                <Link to="/" className="mobile-only button">MM</Link>

              </div>

              <div className="col-6 right">
                
                <a href="#" className="toggler" onClick = {()=>setOpen(!open)}><span/><span/><span/></a>

                <ul className='desktopMenu'> 

                  <li><span className="status-icon"></span><a target="_blank" rel="noopener" href="https://www.youtube.com/@DemystifyingDesign">LIVE UI Design<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg>
</a></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/hello" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

            <div className="row">
                
             <div className="col-12">
                
                <ul open={open} className= {'mobileMenu ' + (open ? 'open' : 'closed')}> 

                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>
                  <li><a target="_blank" rel="noopener" href="https://www.youtube.com/@DemystifyingDesign">LIVE UI Design<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg>
</a></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/hello" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

          </nav>
        )}
      />
  	)
}

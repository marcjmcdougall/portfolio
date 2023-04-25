import { StaticQuery, graphql, Link } from 'gatsby'
import React, { useState } from "react"
import Img from "gatsby-image"
import { PopupText } from "react-calendly"
import externalIcon from '../img/arrow-right-up.svg';


export default function Navbar() {

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

              </div>

              <div className="col-6 right">
                
                <a href="#" className="toggler" onClick = {()=>setOpen(!open)}><span/><span/><span/></a>

                <ul className='desktopMenu'> 

                  <li><span class="status-icon"></span><a target="_blank" rel="noopener" href="https://www.youtube.com/@demystifying-design">LIVE UI Design<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg>
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
                  <li><a target="_blank" rel="noopener" href="https://www.youtube.com/channel/UC5EU0syk1Am-c_zpOeYQXfw">Live UI Design<svg style={{paddingBottom: '5px'}} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497.6,0,334.4.17A14.4,14.4,0,0,0,320,14.57V47.88a14.4,14.4,0,0,0,14.69,14.4l73.63-2.72,2.06,2.06L131.52,340.49a12,12,0,0,0,0,17l23,23a12,12,0,0,0,17,0L450.38,101.62l2.06,2.06-2.72,73.63A14.4,14.4,0,0,0,464.12,192h33.31a14.4,14.4,0,0,0,14.4-14.4L512,14.4A14.4,14.4,0,0,0,497.6,0ZM432,288H416a16,16,0,0,0-16,16V458a6,6,0,0,1-6,6H54a6,6,0,0,1-6-6V118a6,6,0,0,1,6-6H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V304A16,16,0,0,0,432,288Z"/></svg></a></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/strategy-call" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

          </nav>
        )}
      />
  	)
}

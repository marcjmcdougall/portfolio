import { StaticQuery, graphql, Link } from 'gatsby'
import React, { useState } from "react"
import Img from "gatsby-image"
import { PopupText } from "react-calendly"

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

              <div className="col-3"><Link to="/"><Img fluid={data.file.childImageSharp.fluid} alt="Marc McDougall's signature" style={{ maxWidth: '160px' }}/></Link></div>

              <div className="col-9 right">
                
                <a href="#" className="toggler" onClick = {()=>setOpen(!open)}><span/><span/><span/></a>

                <ul className='desktopMenu'> 

                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>
                  <li><a target="_blank" rel="noopener" href="https://www.youtube.com/channel/UC5EU0syk1Am-c_zpOeYQXfw">Live Redesigns<svg style={{paddingBottom: '5px'}} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497.6,0,334.4.17A14.4,14.4,0,0,0,320,14.57V47.88a14.4,14.4,0,0,0,14.69,14.4l73.63-2.72,2.06,2.06L131.52,340.49a12,12,0,0,0,0,17l23,23a12,12,0,0,0,17,0L450.38,101.62l2.06,2.06-2.72,73.63A14.4,14.4,0,0,0,464.12,192h33.31a14.4,14.4,0,0,0,14.4-14.4L512,14.4A14.4,14.4,0,0,0,497.6,0ZM432,288H416a16,16,0,0,0-16,16V458a6,6,0,0,1-6,6H54a6,6,0,0,1-6-6V118a6,6,0,0,1,6-6H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V304A16,16,0,0,0,432,288Z"/></svg></a></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/hello" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

            <div class="row">
                
             <div className="col-12">
                
                <ul open={open} className= {'mobileMenu ' + (open ? 'open' : 'closed')}> 

                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/strategy-call" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

          </nav>
        )}
      />
  	)
}

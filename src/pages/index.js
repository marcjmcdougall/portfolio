import React, {useEffect} from "react"
import { graphql, Link } from 'gatsby'
import { GatsbyImage } from "gatsby-plugin-image"
import LayoutStandard from '../components/layouts/Standard'
import { Helmet } from "react-helmet"


export default function Home({ data }) {

	const localFiles = data.allFile.nodes;

	useEffect(() => {

	}, [])

  return (
      <LayoutStandard>

      <Helmet
          bodyAttributes={{
              class: 'homepage'
          }}

          htmlAttributes={{
            id: 'root'
          }}
      />

          <section id="homepage-hero" className="row vcenter">

              <div className="container">

                  <div className="col-7 text-content">

                      <h1>Design that actually drives <span className="accent">business results.</span></h1>
                      <p>I design simple, customer-centric interfaces to help software companies land more customers & minimize churn.</p>
                      <div className="cta-wrapper">
                          <a className="button" href="/portfolio">See My Work</a>
                      </div>

                  </div>

                  <div className="col-5 hidden-sm">

                      <div className="homepage-img-wrapper">

                          <div className="homepage-img">

                              <div className="statistic statistic-3">
                                      
                                      <div className="text">
                                          <label>Weekly Active Users</label>
                                          <p className="h4">1,347</p>
                                      </div>

                                      <div className="delta">+ 122</div>

                              </div>

                              <div className="statistic statistic-2">
                                      
                                      <div className="text">
                                          <label>Session Duration</label>
                                          <p className="h4">1m 23s</p>
                                      </div>

                                      <div className="delta">+ 9s</div>

                              </div>

                              {/*<img src={me} alt="Me!" />*/}
                              {/*TODO: Make this smoother with a custom fade in perhaps?*/}
                              <GatsbyImage onLoad={() => {
                                    //  console.log('loaded, baby!'); 
                                      }} image={localFiles.find(n => n.name == 'me-cutout').childImageSharp.gatsbyImageData} alt="Profile picture of Marc McDougall"/>

                              <div className="statistic statistic-1">
                                      
                                      <div className="text">
                                          <label>Trial Conversions</label>
                                          <p className="h4">459</p>
                                      </div>

                                      <div className="delta">+ 14</div>

                              </div>

                          </div>

                          {/*<img src="/webpage.svg"/>*/}

                          {/*<div className="exclamation exclamation-1">

                              <Img fluid={localFiles.find(n => n.name == 'me-1').childImageSharp.fluid}/>

                              <p>“This site is so easy to use — <strong>signing up</strong> was a no-brainer!”</p>

                          </div>

                          <div className="exclamation exclamation-2">

                              <Img fluid={localFiles.find(n => n.name == 'me-2').childImageSharp.fluid}/>
                              <p>“It was so <strong>easy to checkout here</strong>&hellip;I’m never using Amazon again!”</p>

                          </div>

                          <div className="exclamation exclamation-3">

                              <Img fluid={localFiles.find(n => n.name == 'me-3').childImageSharp.fluid}/>
                              <p>“This software really speaks to me&hellip;better sign up for that <strong>free trial!</strong>”</p>

                          </div>*/}
                      </div>

                  </div>

              </div>

          </section>

          <section id="work-sample">

              <div className="container">

                  <div className="row">

                      <div className="col-12 sectionTitle">

                          <h2>Featured Work</h2>
                          <Link to="/portfolio" className="button">All Work</Link>

                      </div>

                      {/*<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>*/}

                      {data.allWpPortfolio.nodes.map((post, i) => (

                          <div className="col-12 archive-portfolio active" key={i}>

                              <div className="wrap">
                                  
                                  <Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <GatsbyImage image={post.featuredImage.node.localFile.childImageSharp.gatsbyImageData} alt="" className="bgImage"/> : null }</Link>

                                  <div className="rightSide">

                                      <div className="text">

                                          <Link to={'/portfolio/' + post.slug}><h3>{post.portfolioData.projectSimpleTitle}</h3></Link>
                                          <p className="meta">{(post.portfolioTags.nodes.length > 0) ? post.portfolioTags.nodes[0].name : ''}</p>
                                          <p dangerouslySetInnerHTML={{ __html: post.portfolioData.projectSimpleDescription }}></p>

                                      </div>

                                      <Link to={'/portfolio/' + post.slug} className="button">Read More</Link>

                                  </div>

                              </div>

                          </div>

                      ))}

                      </div>

                          <div className="row">

                              <div id="youtube-cta" className="col-12">
                      
                              <div className="leftContent">
                                  
                                  <h3>Watch me design <span className="accent">in real time.</span></h3>
                                  <p>Every week, I redesign popular product UIs LIVE on my YouTube channel, <em>Demystifying Design</em>.</p>

                              </div>

                              <div className="rightContent">
                                  
                                  <a target="_blank" className="button accent" rel="noopener" href="https://www.youtube.com/@DemystifyingDesign"><span className="status-icon light"></span>LIVE UI Design<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg></a>

                              </div>

                          </div>

                      </div>

                  </div>

          </section>

          <section id="testimonials">

              <div className="container">

                  <div className="row">

                      <div className="col-12 sectionTitle">

                          <h2>Featured Testimonials</h2>
                          <Link to="/testimonials" className="button">All Testimonials</Link>

                      </div>

                      {/*<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>*/}

                      {data.allWpTestimonial.nodes.map((post, i) => (

                          <div className="col-12 archive-testimonial" key={i} >
                              <p dangerouslySetInnerHTML={{ __html: '\"' + post.testimonialData.testimonial + '\"' }}></p>

                              {post.testimonialData.profileImage ? <GatsbyImage image={post.testimonialData.profileImage.localFile.childImageSharp.gatsbyImageData} alt={"Profile photo for " + post.title}/> : null }

                              <div className="text-content">
                                <h4>{post.title}</h4>
                                <p>{post.testimonialData.siteName}</p>
                              </div>
                          </div>

                      ))}

                          <div className="col-12 mobile-only">

                              <Link to="/testimonials" className="button">See All Testimonials</Link>

                          </div>

                      </div>

                  </div>

          </section>

      </LayoutStandard>
  );
}

export const query = graphql`{
  allWpPortfolio(
    sort: {fields: [date], order: DESC}
    limit: 2
    filter: {portfolioData: {showOnHomepage: {eq: true}}}
  ) {
    nodes {
      content
      slug
      featuredImage {
        node {
          localFile {
            childImageSharp {
              gatsbyImageData(layout: FULL_WIDTH)
            }
          }
          id
        }
      }
      portfolioTags {
        nodes {
          slug
          name
        }
      }
      portfolioData {
        projectSimpleDescription
        projectSimpleTitle
        results
        showOnHomepage
      }
    }
  }
  allWpTestimonial(sort: {fields: date, order: DESC}, limit: 3) {
    nodes {
      id
      title
      testimonialData {
        siteName
        testimonial
        profileImage {
          localFile {
            childImageSharp {
              gatsbyImageData(layout: FULL_WIDTH)
            }
          }
        }
      }
    }
  }
  allFile(filter: {absolutePath: {regex: "/(/home)//"}}) {
    nodes {
      relativePath
      name
      childImageSharp {
        gatsbyImageData(layout: FULL_WIDTH)
        fixed(width: 400, height: 400) {
          ...GatsbyImageSharpFixed
        }
      }
    }
  }
}`

import React, {useEffect, useState, useRef} from "react"
import { graphql, Link } from 'gatsby'
import { GatsbyImage } from "gatsby-plugin-image"
import LayoutStandard from '../components/layouts/Standard'
import { PopupButton } from 'react-calendly'
import { Helmet } from "react-helmet"
// import { Video } from 'gatsby-video'
import VideoPreview from "../img/hello-preview.mp4"
import Video from "../img/hello.mp4"


export default function Home({ data }) {

	const localFiles = data.main.nodes;
  const logos = data.logos.nodes;
  const testimonials = data.testimonials.nodes;

  const [isModalOpen, setIsModalOpen] = useState(false)
  const openModal = () => setIsModalOpen(true);
  const closeModal = () => setIsModalOpen(false);
  const modalRef = useRef(null);
  const videoRef = useRef(null);
  const [currentTime, setCurrentTime] = useState(0);
  const [duration, setDuration] = useState(0);


  const handleOutsideClick = (e) => {
    // console.log('outside click');
    if (modalRef.current && !modalRef.current.contains(e.target)) {
        closeModal();
    } 
  }

  const toggleVideoPlayPause = (event) => {
    const video = videoRef.current;
    if(video) {
      if (video.paused) {
        video.play();
      } else {
        video.pause();
      }
    }
  }

  const modalStyles = {
    position: "fixed",
    top: 0,
    left: 0,
    width: "100%",
    height: "100%",
    backgroundColor: "rgba(0, 0, 0, 0.8)",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    zIndex: 1000,
};

const closeButtonStyles = {
    position: "absolute",
    top: "30px",
    right: "30px",
    fontSize: "1rem",
    color: "#fff",
    border: "1px solid #777777",
    background: "transparent",
    cursor: "pointer",
};

const videoStyles = {
    maxWidth: "90%",
    maxHeight: "90%",
};

const formatTime = (time) => {
  const minutes = Math.floor(time / 60);
  const seconds = Math.floor(time % 60);
  return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
};

useEffect(() => {
  const video = videoRef.current;
  if (video) {
    const handleTimeUpdate = () => {
      setCurrentTime(video.currentTime);
    };

    video.addEventListener('timeupdate', handleTimeUpdate);

    return () => {
      video.removeEventListener('timeupdate', handleTimeUpdate);
    };
  }
}, []);

  useEffect(() => {
    if (isModalOpen) {
        // Prevent scrolling
        document.body.style.overflow = "hidden"
    } else {
        // Allow scrolling
        document.body.style.overflow = "auto"
    }

    return () => {
        // Cleanup the style if the component unmounts while the modal is open
        document.body.style.overflow = "auto"
    }
  }, [isModalOpen])

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
                          <a className="button accent" href="https://calendly.com/kbs-marc/hello" target="_blank" rel="noopener">Let's Talk</a>
                          <a className="button" href="/portfolio">See My Work</a>
                      </div>

                      <div id="social-proof">
                        <div className="client-visualization">
                          <div class="client-avatars">
                            <GatsbyImage image={testimonials.find(n => n.name == 'justin-olson').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="client-avatar client-avatar--first"/>
                            <GatsbyImage image={testimonials.find(n => n.name == 'sarah-monaghan').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="client-avatar client-avatar--second"/>
                            <GatsbyImage image={testimonials.find(n => n.name == 'justin-betteridge').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="client-avatar client-avatar--third"/>
                            <GatsbyImage image={testimonials.find(n => n.name == 'brucie-christy').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="client-avatar client-avatar--fourth"/>
                          </div>
                        </div>
                        450+ happy clients and counting!
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
                              <GatsbyImage onLoad={() => {
                                    //  console.log('loaded, baby!'); 
                                      }} image={localFiles.find(n => n.name == 'me-cutout-1').childImageSharp.gatsbyImageData} placeholder="none" alt="Profile picture of Marc McDougall"/>

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

          {/* <section id="featured-in">
              <div className="container">
                <div className="row">
                  <div className="col-12 logos">
                      <GatsbyImage image={logos.find(n => n.name == 'zoom').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="logo-item logo-item--first"/>
                      <GatsbyImage image={logos.find(n => n.name == 'solvvy').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="logo-item logo-item--second"/>
                      <GatsbyImage image={logos.find(n => n.name == 'safesend').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="logo-item logo-item--third"/>
                      <GatsbyImage image={logos.find(n => n.name == 'turing').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="logo-item logo-item--fourth"/>
                      <GatsbyImage image={logos.find(n => n.name == 'cointree').childImageSharp.gatsbyImageData} placeholder="none" width="100px" alt="A logo of the company Zoom" className="logo-item logo-item--fifth"/>
                  </div>
                </div>
              </div>
          </section> */}

          <section id="how-it-works">
              <div className="container">
                <div className="row">
                  <div className="col-6 work-option-item">
                      <div class="icon">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g id="Icon / Filter">
                          <path id="Vector" d="M27.5 3.75H2.5L12.5 15.575V23.75L17.5 26.25V15.575L27.5 3.75Z" stroke="#0C1A31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </g>
                        </svg>
                      </div>
                      <h2>Convesion rate optimization</h2>
                      <p>Marketing funnel underperforming?  I'll audit it and explain how to fix it, or do it for you.</p>
                  </div>

                  <div className="col-6 work-option-item">
                      <div class="icon">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g id="Icon / Refresh">
                          <path id="Vector" d="M28.75 5V12.5H21.25" stroke="#0C1A31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path id="Vector_2" d="M1.25 25V17.5H8.75" stroke="#0C1A31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path id="Vector_3" d="M4.3875 11.25C5.02146 9.45845 6.09892 7.85673 7.51933 6.59424C8.93975 5.33176 10.6568 4.44968 12.5104 4.0303C14.3639 3.61091 16.2934 3.6679 18.119 4.19594C19.9445 4.72398 21.6066 5.70586 22.95 7.04997L28.75 12.5M1.25 17.5L7.05 22.95C8.39343 24.2941 10.0555 25.276 11.881 25.804C13.7066 26.332 15.6361 26.389 17.4896 25.9696C19.3432 25.5503 21.0602 24.6682 22.4807 23.4057C23.9011 22.1432 24.9785 20.5415 25.6125 18.75" stroke="#0C1A31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </g>
                        </svg>
                      </div>
                      <h2>Churn reduction</h2>
                      <p>Losing customers because of a clunky UI?  I'll interview them and redesign it.</p>
                  </div>
                </div>
              </div>
          </section>

          <section id="process-video">
              <div className="container">
                <div className="row">
                  <div className="col-12">
                      <div id="process-video-anchor">
                        <div id="process-video-wrapper">
                          <div id="process-video-content">
                            <h2>The Process</h2>
                            <p>Got a minute?  I’ll explain how my design practice works, so you can see if we'd be a good fit.</p>
                            <button className="button animated-button" href="#" onClick={openModal}>Watch Now</button>
                          </div>
                          <div id="process-video-overlay"></div>
                          <video muted autoPlay loop width="100%">
                            <source src={VideoPreview} type="video/mp4"/>
                          </video>
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              {isModalOpen && (
                  <div className="modal modal-fullscreen" style={modalStyles} onClick={handleOutsideClick}>
                      <div ref={modalRef} className="modal-wrapper">
                        <a style={closeButtonStyles} onClick={closeModal} className="button closeButton">
                            <span className="closeText">
                              Close
                            </span>
                            <span className="closeIcon">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="close">
                                <path id="Icon" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#1F252F"/>
                                </g>
                              </svg>
                            </span>
                        </a>
                        {/* <video ref={videoRef} autoPlay width="100%" onClick={toggleVideoPlayPause}>
                            <source src={Video} type="video/mp4"/>
                        </video> */}
                        {/* <script src="https://fast.wistia.com/embed/medias/k88pwtr886.jsonp" async></script>
                        <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
                        <div class="wistia_responsive_padding">
                          <div class="wistia_responsive_wrapper">
                            <div class="wistia_embed wistia_async_k88pwtr886 seo=false videoFoam=true">
                              <div class="wistia_swatch">
                                <img src="https://fast.wistia.com/embed/medias/k88pwtr886/swatch" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" />
                              </div>
                            </div>
                          </div>
                        </div> */}


                        <div class="wistia_responsive_padding" style={{padding: '56.25% 0 0 0', position: 'relative',}}>
                          <div class="wistia_responsive_wrapper" style={{ height: '100%', left: '0', position: 'absolute', top: '0', width: '100%'}}>
                              <a style={closeButtonStyles} onClick={closeModal} className="button closeButton closeButtonMobile">
                                <span className="closeText">
                                  Close
                                </span>
                                <span className="closeIcon">
                                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="close">
                                    <path id="Icon" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#1F252F"/>
                                    </g>
                                  </svg>
                                </span>
                            </a>
                            <iframe src="https://fast.wistia.net/embed/iframe/k88pwtr886?seo=false&videoFoam=true" title="hello Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%">
                            </iframe>

                            <div class="modal-cta--mobile">
                              <p>Think we'd be a good fit?</p>
                              <a className="button" href="https://calendly.com/kbs-marc/hello" target="_blank" rel="noopener">Let's Talk</a>
                            </div>
                          </div>
                        </div>
                        <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

                        {/* <div class="scrubber">
                          <div>{formatTime(currentTime)} / {formatTime(duration)}</div>
                          <progress value={currentTime} max={duration}></progress>
                        </div> */}
                        <div class="modal-cta">
                          <p>Think we'd be a good fit?</p>
                          <a className="button" href="https://calendly.com/kbs-marc/hello" target="_blank" rel="noopener">Let's Talk</a>
                        </div>
                      </div>
                  </div>
              )}
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
                                  <p>Every week, I redesign popular software interfaces LIVE on my YouTube channel, <em>Demystifying Design</em>.</p>

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
  main: allFile(filter: {absolutePath: {regex: "/(/home)//"}}) {
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
  logos: allFile(filter: {absolutePath: {regex: "/(/logos)//"}}) {
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
  testimonials: allFile(filter: {absolutePath: {regex: "/(/testimonials)//"}}) {
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

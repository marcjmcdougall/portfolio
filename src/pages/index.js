import React, {useEffect} from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import BackgroundImage from 'gatsby-background-image'
import LayoutStandard from '../components/layouts/Standard'
import me from '../img/home/me-cutout.png';


export default function Home({ data }) {

	const localFiles = data.allFile.nodes;

	useEffect(() => {

		console.log('hiiiiiii');


	}, [])

  return (

  		<LayoutStandard>

	  		<section id="homepage-hero" className="row vcenter">

		  		<div className="container">

		  			<div className="col-7 text-content">

		  				<h1>Design that actually drives <span className="accent">business results.</span></h1>
		  				<p>I design simple, customer-centric interfaces to help SaaS companies activate more users & minimize churn.</p>
		  				<div className="cta-wrapper">

		  					<a className="accent button" href="/"><svg style={{marginTop : 1}} className="left" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.66675 5.50001C1.66675 4.57954 2.41294 3.83334 3.33341 3.83334H16.6667C17.5872 3.83334 18.3334 4.57954 18.3334 5.50001V14.6667C18.3334 15.5872 17.5872 16.3333 16.6667 16.3333H12.8453L10.5893 18.5893C10.2639 18.9147 9.73626 18.9147 9.41083 18.5893L7.1549 16.3333H3.33341C2.41294 16.3333 1.66675 15.5872 1.66675 14.6667V5.50001ZM16.6667 5.50001H3.33341V14.6667H7.50008C7.7211 14.6667 7.93306 14.7545 8.08934 14.9108L10.0001 16.8215L11.9108 14.9108C12.0671 14.7545 12.2791 14.6667 12.5001 14.6667H16.6667V5.50001ZM5.00008 8.41668C5.00008 7.95644 5.37318 7.58334 5.83341 7.58334H14.1667C14.627 7.58334 15.0001 7.95644 15.0001 8.41668C15.0001 8.87691 14.627 9.25001 14.1667 9.25001H5.83341C5.37318 9.25001 5.00008 8.87691 5.00008 8.41668ZM5.00008 11.75C5.00008 11.2898 5.37318 10.9167 5.83341 10.9167H10.8334C11.2937 10.9167 11.6667 11.2898 11.6667 11.75C11.6667 12.2102 11.2937 12.5833 10.8334 12.5833H5.83341C5.37318 12.5833 5.00008 12.2102 5.00008 11.75Z" fill="#D8E6FD"/></svg>
 Let's Talk</a>
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
			  					<Img durationFadeIn={300} onLoad={() => {
    									console.log('loaded, baby!');
  										}} fluid={localFiles.find(n => n.name == 'me-cutout').childImageSharp.fluid}/>

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
			  				<Link to="/portfolio" className="button">See All Work</Link>

			  			</div>

			  			{/*<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>*/}

			  			{data.allWpPortfolio.nodes.map(post => (

				  			<div className="col-12 archive-portfolio active">

				  				<div className="wrap">
					  				
					  				<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <BackgroundImage fluid={post.featuredImage.node.localFile.childImageSharp.fluid} className="bgImage"/> : null }</Link>

					  				<div className="rightSide">

					  					<div className="text">

					  						<Link to={'/portfolio/' + post.slug}><h3>{post.portfolioData.projectSimpleTitle}</h3></Link>
					  						<p className="meta">Cloud Computing</p>
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
				  					
				  					<a target="_blank" className="button accent" rel="noopener" href="https://www.youtube.com/@demystifying-design"><span class="status-icon light"></span>LIVE UI Design<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg></a>

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
			  				<Link to="/testimonials" className="button">See All Testimonials</Link>

			  			</div>

			  			{/*<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>*/}

			  			{data.allWpTestimonial.nodes.map(post => (

				  			<div className="col-12 archive-testimonial">
				  				<p dangerouslySetInnerHTML={{ __html: '\"' + post.testimonialData.testimonial + '\"' }}></p>

				  				{post.testimonialData.profileImage ? <Img fluid={post.testimonialData.profileImage.localFile.childImageSharp.fluid}/> : null }

						        <div className="text-content">
						          <h4>{post.title}</h4>
						          <p>{post.testimonialData.siteName}</p>
						        </div>
						    </div>

			  			))}

			  			</div>

			  		</div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`query{
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
              fluid {
                ...GatsbyImageSharpFluid
              }
            }
          }
          id
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
  allWpTestimonial(
  	sort: {fields: date, order: DESC}
  	limit: 3) {
    nodes {
      id
      title
      testimonialData {
        siteName
        testimonial
        profileImage {
          localFile {
            childImageSharp {
              fluid {
                ...GatsbyImageSharpFluid
              }
            }
          }
        }
      }
    }
  }
  allFile(filter: {absolutePath: {regex: "/(\/home)\//"  }}) {
    nodes {
      relativePath
      name
      childImageSharp {
        fluid{
        	...GatsbyImageSharpFluid
        }
        fixed(width: 400, height: 400) {
		      ...GatsbyImageSharpFixed
		    }
      }
    }
  }
}`

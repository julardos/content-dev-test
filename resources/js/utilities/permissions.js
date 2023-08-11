export function creatorCan(props) {
    let user = props?.auth?.user;
    return user.is_content_creator;
}

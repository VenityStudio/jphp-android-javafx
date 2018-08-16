package org.venity.jphp.ext.android.android.classes;

import com.gluonhq.charm.glisten.application.MobileApplication;
import com.gluonhq.charm.glisten.mvc.View;
import org.venity.jphp.ext.android.AndroidExtension;
import org.venity.jphp.ext.android.fx.classes.UXApplication;
import php.runtime.annotation.Reflection;
import php.runtime.env.Environment;
import php.runtime.reflection.ClassEntity;

@Reflection.Name("UXMobileApplication")
@Reflection.Namespace(AndroidExtension.NS_ANDROID)
public class UXMobileApplication extends UXApplication {

    public UXMobileApplication(Environment env, MobileApplication wrappedObject) {
        super(env, wrappedObject);
    }

    public UXMobileApplication(Environment env, ClassEntity clazz) {
        super(env, clazz);
    }

    @Reflection.Signature
    public static void addView(String name, View view)
    {
        MobileApplication.getInstance().addViewFactory(name, () -> return view);
    }

    @Reflection.Signature
    public static void showView(String name)
    {
        MobileApplication.getInstance().switchView(name);
    }
}
